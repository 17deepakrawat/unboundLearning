<?php

namespace App\Http\Controllers\Settings\LMS;

use App\Http\Controllers\Controller;
use App\Models\Academics\Vertical;
use App\Models\Leads\Opportunity;
use App\Models\Settings\LMS\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('view notification'))
        {
            if (request()->ajax()) {
      
                $data = Notification::orderBy('id', 'desc')->get();
        
                return DataTables::of($data)
                  ->addIndexColumn()
                  ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME','UTC'))->format('d-m-Y h:i A');
                    return $formatedDate;
                  })
                  ->make(true);
              }
              return view("settings.lms.notification.index");
        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create notification'))
        {
            $verticals = Vertical::all();
            return view('settings.LMS.notification.create',compact('verticals'));
        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }

    public function store(Request $request)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create notification'))
        {
            try{
                $validate = Validator::make($request->all(),[
                    'title'=>'required',
                    'vertical_id'=>'required',
                    'specialization_id'=>'required',
                    'description'=>'required',
                ])->validate();
                $request->request->set('attachment','');
                if($request->hasFile('file'))
                {
                    $path = 'uploads/notification/';
                    $fileName = time().'.'.$request->file->extension();
                    $request->file->move(public_path($path), $fileName);
                    $filePath = $path.$fileName;
                    $request->request->set('attachment',$filePath);
                }
                $notification = Notification::create($request->all());
                return response()->json([
                    'status'=>'success',
                    'message'=>'Notification sent successfull'
                ]);
            }
            catch(Exception $e)
            {
                return response()->json(['status'=>'error','message'=>$e->getMessage()]);
            }

        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }
    public function update(Request $request,$notificationId)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('edit notification'))
        {
            try{
                $validate = Validator::make($request->all(),[
                    'title'=>'required',
                    'vertical_id'=>'required',
                    'specialization_id'=>'required',
                    'description'=>'required',
                ])->validate();
                if($request->hasFile('file'))
                {
                    $path = 'uploads/notification/';
                    $fileName = time().'.'.$request->file->extension();
                    $request->file->move(public_path($path), $fileName);
                    $filePath = $path.$fileName;
                    $request->request->set('attachment',$filePath);
                }
                $request->request->remove('_method');
                $request->request->remove('_token');
                $notification = Notification::where('id',$notificationId)->update($request->all());
                return response()->json([
                    'status'=>'success',
                    'message'=>'Notification sent successfull'
                ]);
            }
            catch(Exception $e)
            {
                return response()->json(['status'=>'error','message'=>$e->getMessage()]);
            }

        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }

    public function edit($notificationId)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('edit notification'))
        {
            $verticals = Vertical::all();
            $notification = Notification::find($notificationId);
            return view('settings.LMS.notification.edit',compact('verticals','notification'));
        }
        else
        {
            return response()->view('errors.403', [], 403);
        }
    }

    public function status($id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('edit notification')) {
            try {
              $notification = Notification::findOrFail($id);
              if ($notification) {
                $notification->is_active = $notification->is_active == 1 ? 0 : 1;
                $notification->save();
                return response()->json([
                  'status' => 'success',
                  'message' => $notification->title . ' status updated successfully!',
                ]);
              } else {
                return response()->json([
                  'status' => 'error',
                  'message' => 'Notification not found',
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

    public function getStudentNotification()
    {
        $opportunity = Opportunity::where('lead_id',Auth::guard('student')->user()->id)->where('specialization_id',session()->get('specialization_id'))->get(['vertical_id','admission_duration']);
        if($opportunity->count()>0)
        {
            if (request()->ajax()) {
                $data = Notification::where('vertical_id',$opportunity[0]->vertical_id)->where('specialization_id',session()->get('specialization_id'))->orWhere('duration',$opportunity[0]->duration)->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($data) {
                        $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME','UTC'))->format('d-m-Y h:i A');
                        return $formatedDate;
                    })
                    ->make(true);
            }
        }
        return view('panel.dashboards.lms.notification.index');
    }

    public function viewNotification($id)
    {
        $notification = Notification::find($id);
        return view('panel.dashboards.lms.notification.view',compact('notification'));
    }
}
