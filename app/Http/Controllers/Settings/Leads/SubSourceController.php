<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Leads\SubSource;
use App\Models\Settings\Leads\Source;
use App\Http\Requests\Settings\Leads\SubSourceRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class SubSourceController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view sub-sources')) {
      if ($request->ajax()) {

        $data = SubSource::with('source')->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.leads.sub-sources.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create sub-sources')) {
      $sources = Source::all();
      return view('settings.leads.sub-sources.create', ['sources' => $sources]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(SubSourceRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create sub-sources')) {
      try {
        $subSource = SubSource::create($request->all());
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
    if (Auth::check() && Auth::user()->hasPermissionTo('edit sub-sources')) {
      try {
        $subSource = SubSource::findOrFail($id);
        if ($subSource) {
          $subSource->is_active = $subSource->is_active == 1 ? 0 : 1;
          $subSource->save();
          return response()->json([
            'status' => 'success',
            'message' => $subSource->name . ' status updated successfully!',
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

  public function getSubSourceBySource($sourceId)
  {
    try {
      $subSources = SubSource::where('source_id', $sourceId)->get();
      return response()->json(['status' => true, 'sub_sources' => $subSources]);
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => $e->getMessage()]);
    }
  }
}
