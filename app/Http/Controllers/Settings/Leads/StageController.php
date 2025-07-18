<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\Leads\StageRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Leads\Stage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class StageController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view stages')) {
      if ($request->ajax()) {

        $data = Stage::orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.leads.stages.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create stages')) {
      return view('settings.leads.stages.create');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(StageRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create stages')) {
      try {
        $stage = Stage::create($request->all());
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
    if (Auth::check() && Auth::user()->hasPermissionTo('edit stages')) {
      try {
        $stage = Stage::findOrFail($id);
        if ($stage) {
          $stage->is_active = $stage->is_active == 1 ? 0 : 1;
          $stage->save();
          return response()->json([
            'status' => 'success',
            'message' => $stage->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Stage not found',
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

  public function initialStatus($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit stages')) {
      try {
        Stage::query()->update(['is_initial' => 0]);
        $stage = Stage::findOrFail($id);
        if ($stage) {
          $stage->is_initial = 1;
          $stage->is_final = 0;
          $stage->save();
          return response()->json([
            'status' => 'success',
            'message' => $stage->name . ' initial status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Stage not found',
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

  public function finalStatus($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit stages')) {
      try {
        Stage::query()->update(['is_final' => 0]);
        $stage = Stage::findOrFail($id);
        if ($stage) {
          $stage->is_final = 1;
          $stage->is_initial = 0;
          $stage->save();
          return response()->json([
            'status' => 'success',
            'message' => $stage->name . ' final status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Stage not found',
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
}
