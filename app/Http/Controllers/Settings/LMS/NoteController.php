<?php

namespace App\Http\Controllers\Settings\LMS;

use App\Http\Controllers\Controller;
use App\Models\Academics\Syllabus;
use App\Models\Academics\Vertical;
use App\Models\Settings\LMS\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class NoteController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view notes')) {
            if (request()->ajax()) {
              $data = Note::orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME','UTC'))->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
            return view("settings.lms.notes.index");
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create notes')) {
            $verticals = Vertical::all();
            return view('settings.lms.notes.create',compact('verticals'));
        }
    }

    public function edit($notesId)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create notes')) {
            $notesData = Note::findOrFail($notesId);
            $verticals = Vertical::all();
            return view('settings.lms.notes.edit',compact('verticals','notesData'));
        }
    }

    public function store(Request $request)
    {
      if(Auth::check() && Auth::user()->hasPermissionTo('create notes'))
      {
          try{
            $request->validate([
                'file' => 'required|mimes:pdf,jpeg,png,jpg,doc',
            ],[
              'file.required'=>'Upload File is required'
            ]);
            $syllabusName = Syllabus::where('id',$request->syllabus_id)->get('name');
            $fileName = time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads/notes/'.$syllabusName[0]->name), $fileName);
            $notePath = 'uploads/notes/'.$syllabusName[0]->name.'/'.$fileName;
            $request->request->set('file_path',$notePath);
            $request->request->remove('file');
            $storeNote = Note::create($request->all());
            return response()->json([
              'status'=>'success',
              'message'=> 'Note created successfull'
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

    public function status($notesId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit notes')) {
        try {
          $notes = Note::findOrFail($notesId);
          if ($notes) {
            $notes->is_active = $notes->is_active == 1 ? 0 : 1;
            $notes->save();
            return response()->json([
              'status' => 'success',
              'message' => $notes->name . ' status updated successfully!',
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

    public function update(Request $request, $notesId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit notes'))
      {
          try{
            if($request->hasFile('file'))
            {
                $syllabusName = Syllabus::where('id',$request->syllabus_id)->get('name');
                $fileName = time().'.'.$request->file->extension();  
                $request->file->move(public_path('uploads/notes/'.$syllabusName[0]->name), $fileName);
                $notePath = 'uploads/notes/'.$syllabusName[0]->name.'/'.$fileName;
                $request->request->set('file_path',$notePath);
            }
            $request->request->remove('_method');
            $request->request->remove('_token');
            $request->request->remove('file');
            // dd($request->all());
            $updateNote = Note::where('id',$notesId)->update($request->except('file'));
            return response()->json([
              'status'=>'success',
              'message'=> 'Note created successfull'
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
