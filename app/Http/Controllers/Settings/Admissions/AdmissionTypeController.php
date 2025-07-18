<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Admissions\AdmissionTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Admissions\AdmissionType;
use App\Models\Academics\Vertical;

class AdmissionTypeController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view admission-types')) {
      if ($request->ajax()) {

        $data = AdmissionType::with('vertical')->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
          $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->addColumn('edit_url', function ($data) {
          $editURL = Auth::user()->hasPermissionTo('edit admission-types') ? route('settings.admissions.admission-types.edit', ['id' => $data->id]) : '';
          return $editURL;
          })
          ->make(true);
      }
      return view('settings.admissions.admission-types.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create admission-types')) {
      $verticals = Vertical::where('for_panel', true)->get(['id', 'short_name', 'vertical_name']);
      return view('settings.admissions.admission-types.create', ['verticals' => $verticals]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(AdmissionTypeRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create admission-types')) {
      try {
        $admissionType = AdmissionType::create($request->all());
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' created successfully!',
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
        $admissionType = AdmissionType::findOrFail($id);
        if ($admissionType) {
          $admissionType->is_active = $admissionType->is_active == 1 ? 0 : 1;
          $admissionType->save();
          return response()->json([
            'status' => 'success',
            'message' => $admissionType->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Admission Type not found',
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

  public function edit($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
      $verticals = Vertical::where('for_panel', true)->get();
      $admissionType = AdmissionType::find($id);
      return view('settings.admissions.admission-types.edit', compact(['verticals', 'admissionType']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(AdmissionTypeRequest $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit admission-types')) {
      try {
        $admissionType = AdmissionType::find($id);
        $admissionType->update([
          'name' => $request->name,
          'vertical_id' => $request->vertical_id,
        ]);

        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', []);
    }
  }

  function admissionTypesByVertical($vertical_id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view admission-types')) {
      $admissionTypes = AdmissionType::where('vertical_id', $vertical_id)->where('is_active', true)->get(['id', 'name']);
      return response()->json(['status' => true, 'data' => $admissionTypes]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }
}
