<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Leads\SourceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Leads\Source;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

class SourceController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view sources')) {
      if ($request->ajax()) {

        $data = Source::orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.leads.sources.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create sources')) {
      return view('settings.leads.sources.create');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(SourceRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create sources')) {
      try {
        $source = Source::create($request->all());
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
    if (Auth::check() && Auth::user()->hasPermissionTo('edit sources')) {
      try {
        $source = Source::findOrFail($id);
        if ($source) {
          $source->is_active = $source->is_active == 1 ? 0 : 1;
          $source->save();
          return response()->json([
            'status' => 'success',
            'message' => $source->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Source not found',
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
