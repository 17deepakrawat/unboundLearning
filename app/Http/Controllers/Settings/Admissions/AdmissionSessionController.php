<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Admissions\AdmissionSessionRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\AdmissionSession;
use App\Models\Settings\Admissions\AdmissionSessionAdmissionType;

class AdmissionSessionController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view admission-sessions')) {
      if ($request->ajax()) {

        $data = AdmissionSession::with(['vertical', 'admissionTypes', 'admissionSessionAdmissionTypes.schemes'])->orderBy('id', 'desc')->get();
        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
          })
          ->addColumn('name', function ($data) {
            return $data->name;
          })
          ->addColumn('edit_url', function ($data) {
            return Auth::user()->hasPermissionTo('edit admission-sessions') ? route('settings.admissions.admission-sessions.edit', ['id' => $data->id]) : '';
          })->make(true);
      }
      return view('settings.admissions.admission-sessions.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create admission-sessions')) {
      $verticals = Vertical::where('for_panel', true)->get(['id', 'short_name', 'vertical_name']);
      return view('settings.admissions.admission-sessions.create', compact(['verticals']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(AdmissionSessionRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create admission-sessions')) {
      try {
        foreach ($request->admission_type_ids as $admissionTypeId) {
          if (!array_key_exists($admissionTypeId, $request->scheme_ids)) {
            return response()->json(['status' => 'error', 'message' => 'Please select Scheme!']);
          }
        }

        $startDates = $request->start_dates;
        foreach ($request->scheme_ids as $admissionTypeId => $schemeIds) {
          foreach ($schemeIds as $schemeId) {
            if (!array_key_exists($admissionTypeId, $startDates) && !array_key_exists($schemeId, $startDates[$admissionTypeId])) {
              return response()->json(['status' => 'error', 'message' => 'Please select Start Date!']);
            }

            if (empty($startDates[$admissionTypeId][$schemeId])) {
              return response()->json(['status' => 'error', 'message' => 'Please select Start Date!']);
            }
          }
        }


        $admissionSession = AdmissionSession::create($request->all());
        $admissionSession->admissionTypes()->sync($request->admission_type_ids);

        foreach ($request->scheme_ids as $admissionTypeId => $schemeIds) {
          foreach ($schemeIds as $schemeId) {
            $admissionSessionAdmissionType = AdmissionSessionAdmissionType::where('admission_session_id', $admissionSession->id)->where('admission_type_id', $admissionTypeId)->first();
            $admissionSessionAdmissionType->schemes()->sync([$schemeId => ['start_date' => Carbon::createFromFormat('d-m-Y', $startDates[$admissionTypeId][$schemeId])->format('Y-m-d')]]);
          }
        }

        return response()->json([
          'status' => 'success',
          'message' => $admissionSession->name . ' created successfully!',
        ]);
      } catch (\Exception $e) {
        $message = strpos($e->getMessage(), 'Duplicate') !== false
          ? $request->name . ' already exists'
          : $e->getMessage();
        return response()->json([
          'status' => 'error',
          'message' => $message,
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }


  public function edit($id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-sessions')) {
      $verticals = Vertical::where('for_panel', true)->get();
      $admissionSession = AdmissionSession::with(['vertical', 'admissionTypes', 'admissionSessionAdmissionTypes'])->find($id);

      $assignedSchemes = array();
      foreach ($admissionSession->admissionSessionAdmissionTypes as $admissionSessionAdmissionType) {
        foreach ($admissionSessionAdmissionType->schemes as $scheme) {
          $assignedSchemes[$admissionSessionAdmissionType->admission_type_id][$scheme->id] = Carbon::createFromFormat('Y-m-d', $scheme->pivot->start_date)->format('d-m-Y');
        }
      }

      return view('settings.admissions.admission-sessions.edit', compact(['verticals', 'admissionSession', 'assignedSchemes']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(AdmissionSessionRequest $request, $admissionSessionId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-sessions')) {
      try {
        foreach ($request->admission_type_ids as $admissionTypeId) {
          if (!array_key_exists($admissionTypeId, $request->scheme_ids)) {
            return response()->json(['status' => 'error', 'message' => 'Please select Scheme!']);
          }
        }

        $startDates = $request->start_dates;
        foreach ($request->scheme_ids as $admissionTypeId => $schemeIds) {
          foreach ($schemeIds as $schemeId) {
            if (!array_key_exists($admissionTypeId, $startDates) && !array_key_exists($schemeId, $startDates[$admissionTypeId])) {
              return response()->json(['status' => 'error', 'message' => 'Please select Start Date!']);
            }

            if (empty($startDates[$admissionTypeId][$schemeId])) {
              return response()->json(['status' => 'error', 'message' => 'Please select Start Date!']);
            }
          }
        }


        $admissionSession = AdmissionSession::find($admissionSessionId);
        $admissionSession->update($request->all());
        $admissionSession->admissionTypes()->sync($request->admission_type_ids);

        foreach ($request->scheme_ids as $admissionTypeId => $schemeIds) {
          foreach ($schemeIds as $schemeId) {
            $admissionSessionAdmissionType = AdmissionSessionAdmissionType::where('admission_session_id', $admissionSession->id)->where('admission_type_id', $admissionTypeId)->first();
            $admissionSessionAdmissionType->schemes()->sync([$schemeId => ['start_date' => Carbon::createFromFormat('d-m-Y', $startDates[$admissionTypeId][$schemeId])->format('Y-m-d')]]);
          }
        }
        return response()->json([
          'status' => 'success',
          'message' => $admissionSession->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        $message = strpos($e->getMessage(), 'Duplicate') !== false
          ? $request->name . ' already exists'
          : $e->getMessage();
        return response()->json([
          'status' => 'error',
          'message' => $message,
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function status($id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
      try {
        $admissionSession = AdmissionSession::findOrFail($id);
        if ($admissionSession) {
          $admissionSession->is_active = $admissionSession->is_active == 1 ? 0 : 1;
          $admissionSession->save();
          return response()->json([
            'status' => 'success',
            'message' => $admissionSession->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Admission Session not found',
          ]);
        }
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    }
  }

  public function currentStatus($id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
      try {

        $admissionSession = AdmissionSession::findOrFail($id);
        if ($admissionSession) {
          AdmissionSession::where('vertical_id', $admissionSession->vertical_id)->update(['current' => 0]);

          $admissionSession->current = 1;
          $admissionSession->save();
          return response()->json([
            'status' => 'success',
            'message' => $admissionSession->name . ' current status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Admission Session not found',
          ]);
        }
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    }
  }

  function admissionSessionsByVertical($verticalId)
  {
    try {
      $admissionSessions = AdmissionSession::where('vertical_id', $verticalId)->get();
      return response()->json([
        'status' => 'success',
        'data' => $admissionSessions
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }

  function schemesByAdmissionSession($admissionSessionId)
  {
    try {
      $admissionSession = AdmissionSession::where('id', $admissionSessionId)->with('admissionSessionAdmissionTypes')->first();
      $schemes = array();
      foreach ($admissionSession->admissionSessionAdmissionTypes as $admissionSessionAdmissionType) {
        foreach ($admissionSessionAdmissionType->schemes as $scheme) {
          $schemes[$scheme->id] = ['id' => $scheme->id, 'name' => $scheme->name, 'start_date' => Carbon::parse($scheme->pivot->start_date)->format('d-m-Y')];
        }
      }

      return response()->json([
        'status' => 'success',
        'data' => $schemes
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }
}
