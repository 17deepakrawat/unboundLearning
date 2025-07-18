<?php

namespace App\Http\Controllers\Settings\Admissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Admissions\FeeStructure;
use App\Models\Academics\Vertical;
use App\Http\Requests\Settings\Admissions\FeeStructureRequest;

class FeeStructureController extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view fee-structures')) {
      if ($request->ajax()) {

        $data = FeeStructure::with('vertical')->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
          return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
          })
          ->addColumn('edit_url', function ($data) {
          return Auth::user()->hasPermissionTo('edit fee-structures') ? route('settings.admissions.fee-structures.edit', ['id' => $data->id]) : '';
          })
          ->make(true);
      }
      return view('settings.admissions.fee-structures.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create fee-structures')) {
      $verticals = Vertical::where('for_panel', true)->get(['id', 'short_name', 'vertical_name']);
      return view('settings.admissions.fee-structures.create', ['verticals' => $verticals]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(FeeStructureRequest $request)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('create fee-structures')) {
      try {
        $feeStructure = FeeStructure::create($request->all());
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
    if (Auth::check() && Auth::user()->hasPermissionTo('edit fee-structures')) {
      $verticals = Vertical::where('for_panel', true)->get();
      $feeStructure = FeeStructure::find($id);
      return view('settings.admissions.fee-structures.edit', compact(['verticals', 'feeStructure']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(FeeStructureRequest $request, $id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit fee-structures')) {
      try {
        $feeStructure = FeeStructure::find($id);
        $feeStructure->update($request->all());

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

  public function status($id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('edit fee-structures')) {
      try {
        $feeStructure = FeeStructure::findOrFail($id);
        if ($feeStructure) {
          $feeStructure->is_active = $feeStructure->is_active == 1 ? 0 : 1;
          $feeStructure->save();
          return response()->json([
            'status' => 'success',
            'message' => $feeStructure->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Fee Structure not found',
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

  public function feeStructureByVertical($vertical_id)
  {
    $user = Auth::user();
    if (Auth::check() && Auth::user()->hasPermissionTo('view fee-structures')) {
      $feeStructures = FeeStructure::where('vertical_id', $vertical_id)->where('is_active', true)->get(['id', 'name']);
      return response()->json(['status' => true, 'data' => $feeStructures]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }
}
