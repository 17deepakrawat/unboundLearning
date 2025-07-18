<?php

namespace App\Http\Controllers\Settings\LMS;

use App\Http\Controllers\Controller;
use App\Models\Settings\LMS\QueryType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class QueryTypeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view query-type')) {
            if (request()->ajax()) {
              $data = QueryType::orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
            return view("settings.LMS.query-type.index");
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create query-type')) {
            return view('settings.LMS.query-type.create');
        }
    }

    public function edit($queryTypeId)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create query-type')) {
            $queryTypeData = QueryType::findOrFail($queryTypeId);
            return view('settings.lms.query-type.edit',compact('queryTypeData'));
        }
    }

    public function store(Request $request)
    {
      if(Auth::check() && Auth::user()->hasPermissionTo('create query-type'))
      {
          try{
            $storeQuery = QueryType::create($request->only('name'));
            return response()->json([
              'status'=>'success',
              'message'=> 'Query Type created successfull'
            ]);
          }catch(\Exception $e)
          {
            return response()->json([
              'status'=>'error',
              'message'=> $e->getMessage()
            ]);
          }
      }else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function status($queryTypeId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit notes')) {
        try {
          $query = QueryType::findOrFail($queryTypeId);
          if ($query) {
            $query->is_active = $query->is_active == 1 ? 0 : 1;
            $query->save();
            return response()->json([
              'status' => 'success',
              'message' => $query->name . ' status updated successfully!',
            ]);
          } else {
            return response()->json([
              'status' => 'error',
              'message' => 'Notes not found',
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

    public function update(Request $request, $queryTypeId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit query-type'))
      {
          try{
            $updateQuery = QueryType::where('id',$queryTypeId)->update($request->only('name'));
            return response()->json([
              'status'=>'success',
              'message'=> 'Query created successfull'
            ]);
          }catch(\Exception $e)
          {
            return response()->json([
              'status'=>'error',
              'message'=> $e->getMessage()
            ]);
          }
      }
    }
}
