<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Leads\SubStage;
use App\Models\Settings\Leads\Stage;
use App\Http\Requests\Settings\Leads\SubStageRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class SubStageController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view sub-stages')) {
      if ($request->ajax()) {

        $data = SubStage::with('stage')->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.leads.sub-stages.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create sub-stages')) {
      $stages = Stage::get(['id', 'name']);
      return view('settings.leads.sub-stages.create', ['stages' => $stages]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(SubStageRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create sub-stages')) {
      try {
        $subStage = SubStage::create($request->all());
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
    if (Auth::check() && Auth::user()->hasPermissionTo('edit sub-stages')) {
      try {
        $subStage = SubStage::findOrFail($id);
        if ($subStage) {
          $subStage->is_active = $subStage->is_active == 1 ? 0 : 1;
          $subStage->save();
          return response()->json([
            'status' => 'success',
            'message' => $subStage->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Sub-Source not found',
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
