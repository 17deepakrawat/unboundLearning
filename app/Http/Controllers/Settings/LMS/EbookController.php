<?php

namespace App\Http\Controllers\Settings\LMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Academics\Syllabus;
use App\Models\Academics\Vertical;
use App\Models\Settings\LMS\Ebook;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EbookController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view e-books')) {
            if (request()->ajax()) {
              $data = Ebook::orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                  $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
                  return $formatedDate;
                })
                ->make(true);
            }
            return view("settings.lms.ebook.index");
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create e-books')) {
            $verticals = Vertical::all();
            return view('settings.lms.ebook.create',compact('verticals'));
        }
    }

    public function edit($eBookId)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create e-books')) {
            $eBookData = Ebook::findOrFail($eBookId);
            $verticals = Vertical::all();
            return view('settings.lms.ebook.edit',compact('verticals','eBookData'));
        }
    }

    public function store(Request $request)
    {
      if(Auth::check() && Auth::user()->hasPermissionTo('create e-books'))
      {
          try{
            $request->validate([
                'file' => 'required|mimes:pdf,jpeg,png,jpg',
            ],[
              'file.required'=>'Upload File is required'
            ]);
            $syllabusName = Syllabus::where('id',$request->syllabus_id)->get('name');
            $fileName = time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads/e-books/'.$syllabusName[0]->name), $fileName);
            $videoPath = 'uploads/e-books/'.$syllabusName[0]->name.'/'.$fileName;
            $request->request->set('file_path',$videoPath);
            $request->request->remove('file');
            $storeEbook = Ebook::create($request->except('file'));
            return response()->json([
              'status'=>'success',
              'message'=> 'E-Book created successfull'
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

    public function status($ebookId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit e-books')) {
        try {
          $eBook = Ebook::findOrFail($ebookId);
          if ($eBook) {
            $eBook->is_active = $eBook->is_active == 1 ? 0 : 1;
            $eBook->save();
            return response()->json([
              'status' => 'success',
              'message' => $eBook->name . ' status updated successfully!',
            ]);
          } else {
            return response()->json([
              'status' => 'error',
              'message' => 'E-Book not found',
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

    public function update(Request $request, $eBookId)
    {
      if (Auth::check() && Auth::user()->hasPermissionTo('edit e-books'))
      {
          try{
            if($request->hasFile('file'))
            {
                $syllabusName = Syllabus::where('id',$request->syllabus_id)->get('name');
                $fileName = time().'.'.$request->file->extension();  
                $request->file->move(public_path('uploads/e-books/'.$syllabusName[0]->name), $fileName);
                $videoPath = 'uploads/e-books/'.$syllabusName[0]->name.'/'.$fileName;
                $request->request->set('file_path',$videoPath);
            }
            $request->request->remove('_method');
            $request->request->remove('_token');
            $request->request->remove('file');
            $updateEbook = Ebook::where('id',$eBookId)->update($request->except('file'));
            return response()->json([
              'status'=>'success',
              'message'=> 'Ebook created successfull'
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
