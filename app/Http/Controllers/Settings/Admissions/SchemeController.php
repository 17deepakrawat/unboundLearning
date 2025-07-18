<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Admissions\SchemeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\Scheme;

class SchemeController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view schemes')) {
      if ($request->ajax()) {
        $data = Scheme::with(['vertical', 'feeStructures'])->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
          })->editColumn('edit_url', function ($data) {
            return Auth::user()->hasPermissionTo('edit schemes') ? route('settings.admissions.schemes.edit', ['id' => $data->id]) : '';
          })->make(true);
      }
      return view('settings.admissions.schemes.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create schemes')) {
      $verticals = Vertical::where('for_panel', true)->get(['id', 'name', 'short_name', 'vertical_name']);
      return view('settings.admissions.schemes.create', ['verticals' => $verticals]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(SchemeRequest $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create schemes')) {
      try {
        $scheme = Scheme::create($request->all());
        $scheme->feeStructures()->sync($request->fee_structure_ids);

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

  public function edit($id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit schemes')) {
      $verticals = Vertical::all();
      $scheme = Scheme::with(['vertical', 'feeStructures'])->find($id);
      return view('settings.admissions.schemes.edit', compact(['verticals', 'scheme']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }


  public function update(SchemeRequest $request, $id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit schemes')) {
      try {
        $scheme = Scheme::find($id);
        $scheme->update($request->all());
        $scheme->feeStructures()->sync($request->fee_structure_ids);
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' updated successfully!',
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
        $scheme = Scheme::findOrFail($id);
        if ($scheme) {
          $scheme->is_active = $scheme->is_active == 1 ? 0 : 1;
          $scheme->save();
          return response()->json([
            'status' => 'success',
            'message' => $scheme->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Scheme not found',
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

  public function schemesByVertical($verticalId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view schemes')) {
      $schemes = Scheme::where('vertical_id', $verticalId)->where('is_active', true)->get(['id', 'name']);
      return response()->json(['status' => true, 'data' => $schemes]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function feeStructuresByScheme($schemeId)
  {
    try {
      $scheme = Scheme::where('id', $schemeId)->with('feeStructures')->first();
      return response()->json([
        'status' => 'success',
        'data' => $scheme->feeStructures
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }

}
