<?php

namespace App\Http\Controllers\Settings\LMS;

use App\Http\Controllers\Controller;
use App\Models\Academics\Syllabus;
use App\Models\Academics\Vertical;
use App\Models\Settings\LMS\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


 
class VideoController extends Controller
{
    
    public function index()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view videos')) {
            if (request()->ajax()) {
      
              $data = Video::orderBy('id', 'desc')->get();
      
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME','UTC'))->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
            return view("settings.lms.video.index");
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create videos')) {
            $verticals = Vertical::all();
            return view('settings.lms.video.create',compact('verticals'));
        }
    }

    public function edit($videoId)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create videos')) {
            $videoData = Video::findOrFail($videoId);
            $verticals = Vertical::all();
            return view('settings.lms.video.edit',compact('verticals','videoData'));
        }
    }

    public function store(Request $request)
    { 
      if(Auth::check() && Auth::user()->hasPermissionTo('create videos'))
      {
          if($request->hasFile('video_file'))
          {
            $request->validate([
              'video_file' => 'required|mimes:mp4,mkv,avi',
            ]);
            $syllabusName = Syllabus::where('id',$request->syllabus_id)->get('name');
            $fileName = time().'.'.$request->video_file->extension();  
            $request->video_file->move(public_path('uploads/video/'.$syllabusName[0]->name), $fileName);
            $videoPath = 'uploads/video/'.$syllabusName[0]->name.'/'.$fileName;
            $request->request->set('video_path',$videoPath);
          }
          try{
            $storeVideo = Video::create($request->except('video_file'));
            return response()->json([
              'status'=>'success',
              'message'=> 'Video created successfull'
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

    public function status($videoId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit videos')) {
        try {
          $video = Video::findOrFail($videoId);
          if ($video) {
            $video->is_active = $video->is_active == 1 ? 0 : 1;
            $video->save();
            return response()->json([
              'status' => 'success',
              'message' => $video->name . ' status updated successfully!',
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

    public function update(Request $request, $videoId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit videos'))
      {
        if($request->hasFile('video_file'))
          {
            $request->validate([
              'video_file' => 'mimes:mp4,mkv,avi',
            ]);
            $syllabusName = Syllabus::where('id',$request->syllabus_id)->get('name');
            $fileName = time().'.'.$request->video_file->extension();  
            $request->video_file->move(public_path('uploads/video/'.$syllabusName[0]->name), $fileName);
            $videoPath = 'uploads/video/'.$syllabusName[0]->name.'/'.$fileName;
            $request->request->set('video_path',$videoPath);
          }
          try{
            $request->request->remove('_method');
            $request->request->remove('_token');
            $storeVideo = Video::where('id',$videoId)->update($request->except('video_file'));
            return response()->json([
              'status'=>'success',
              'message'=> 'Video created successfull'
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
