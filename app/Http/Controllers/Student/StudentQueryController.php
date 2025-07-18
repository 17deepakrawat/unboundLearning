<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Settings\LMS\QuerySubType;
use App\Models\Settings\LMS\QueryType;
use App\Models\Students\StudentQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StudentQueryController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = StudentQuery::with('queryType')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME','UTC'))->format('d-m-Y h:i A');
                    return $formatedDate;
                })
                ->make(true);
        }
        return view("panel.dashboards.student.query.index");
    }

    public function create()
    {
       {
            $queryType = QueryType::all();
            return view('panel.dashboards.student.query.create',compact('queryType'));
       }
    }

    public function edit($queryId)
    {
            $queryType = QueryType::all();
            $queryData = StudentQuery::where('id',$queryId)->get();
            return view('panel.dashboards.student.query.edit',compact('queryData','queryType'));
    
    }

    public function store(Request $request)
    {
      
          try{
            if($request->hasFile('attachment'))
            {
                $fileName = time().'.'.$request->attachment->extension();  
                $request->attachment->move(public_path('uploads/student/query/'), $fileName);
                $attachmentPath = 'uploads/student/query/'.$fileName;
                $request->request->set('attachment',$attachmentPath);
            }
            $request->request->set('lead_id',Auth::guard('student')->user()->id);
            $storeQuery = StudentQuery::create($request->all());
            return response()->json([
              'status'=>'success',
              'message'=> 'Query submitted successfull'
            ]);
          }catch(\Exception $e)
          {
            return response()->json([
              'status'=>'error',
              'message'=> $e->getMessage()
            ]);
          }
      
    }

    public function update(Request $request, $queryId)
    {
          try{
            if($request->hasFile('attachment'))
            {
                $fileName = time().'.'.$request->attachment->extension();  
                $request->attachment->move(public_path('uploads/student/query/'), $fileName);
                $attachmentPath = 'uploads/student/query/'.$fileName;
                $request->request->set('attachment',$attachmentPath);
            }
            $updateQuery = StudentQuery::where('id',$queryId)->update($request->all());
            return response()->json([
              'status'=>'success',
              'message'=> 'Query updated successfull'
            ]);
          }catch(\Exception $e)
          {
            return response()->json([
              'status'=>'error',
              'message'=> $e->getMessage()
            ]);
          }
      
    }

    public function getQuerySubTypeByQueryType($queryTypeId)
    {
        $query = QuerySubType::where('query_types_id',$queryTypeId)->get();
        return $query;
    }
}
