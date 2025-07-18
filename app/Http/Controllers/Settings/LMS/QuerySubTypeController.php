<?php

namespace App\Http\Controllers\Settings\LMS;

use App\Http\Controllers\Controller;
use App\Models\Settings\LMS\QuerySubType;
use App\Models\Settings\LMS\QueryType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class QuerySubTypeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view query-sub-type')) {
            if (request()->ajax()) {
              $data = QuerySubType::with('queryType')->orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
            return view("settings.LMS.query-sub-type.index");
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create query-sub-type')) {
            $queryType = QueryType::all();
            return view('settings.LMS.query-sub-type.create',compact('queryType'));
        }
    }

    public function edit($queryTypeId)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create query-sub-type')) {
            $querySubTypeData = QuerySubType::findOrFail($queryTypeId);
            $queryType = QueryType::all();
            return view('settings.lms.query-sub-type.edit',compact('querySubTypeData','queryType'));
        }
    }

    public function store(Request $request)
    {
      if(Auth::check() && Auth::user()->hasPermissionTo('create query-sub-type'))
      {
          try{
            $storeQuery = QuerySubType::create($request->only('name','query_types_id'));
            return response()->json([
              'status'=>'success',
              'message'=> 'Query Sub Type created successfull'
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
      if (Auth::check() && Auth::user()->hasPermissionTo('edit query-sub-type')) {
        try {
          $query = QuerySubType::findOrFail($queryTypeId);
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
      if (Auth::check() && Auth::user()->hasPermissionTo('edit query-sub-type'))
      {
          try{
            $updateQuery = QuerySubType::where('id',$queryTypeId)->update($request->only('name','query_types_id'));
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
