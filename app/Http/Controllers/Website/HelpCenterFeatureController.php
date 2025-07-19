<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\HelpCenterFeature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class HelpCenterFeatureController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('view website-help-center-feature')) {
            if (request()->ajax()) {
      
              $data = HelpCenterFeature::orderBy('id', 'desc')->get();
              return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
            }
            return view('website.help-center-feature.index');
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function create()
    {
        return view('website.help-center-feature.create');
    }

    public function store(Request $request)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('create website-help-center-feature'))
        {
            try{
                $store = HelpCenterFeature::insert(['name'=>$request->name]);
                return response()->json(['status'=>'success','message'=>$request->name.' created successfull','id'=> $store->id]);
            }catch(Exception $e)
            {
                return response()->json(['status'=>'success','message'=>$e->getMessage()]);
            }
        }
        else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function edit($id)
    {
        if(Auth::check() && Auth::user()->hasPermissionTo('edit website-help-center-feature'))
        {
            $feature = HelpCenterFeature::findOrFail($id);
            return view('website.help-center-feature.edit',compact('feature'));
        }else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->hasPermissionTo('edit verticals')) {
            $request->validate([
              'id' => ['required', 'exists:help_center_features,id'],
              'content.meta' => ['required', 'array'],
              'content.meta.title' => ['required', 'string'],
              'content.section_1' => ['required', 'string'],
              'images.*' => ['required', 'image', 'mimes:webp,jpeg,png', 'max:300'],
            ]);
            try {
              $feature = HelpCenterFeature::findOrFail($id);
      
              $content = !empty($feature->content) ? json_decode($feature->content, true) : array();
              $content = $request->content;
      
              $images = !empty($feature->images) ? json_decode($feature->images, true) : array();
              if ($request->hasFile('images')) {
                $path = 'assets/img/universities/images';
                if (!File::exists(public_path($path))) {
                  File::makeDirectory(public_path($path), 0777);
                }
                $path = $path . '/' . $request->id;
                if (!File::exists(public_path($path))) {
                  File::makeDirectory(public_path($path), 0777);
                }
      
                foreach ($request->file('images') as $key => $image) {
                  $newFileName = $key . '.' . $image->extension();
                  $image->move(public_path($path), $newFileName);
                  $images[$key] = $path . '/' . $newFileName;
                }
              }      
              $feature->content = json_encode($content);
              $feature->images = json_encode($images);
              $feature->save();
              return response()->json([
                'status' => 'success',
                'message' => $feature->name .' updated successfully!',
              ]);
            } catch (\Exception $e) {
              return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
              ]);
            }
          } else {
            return response()->view('errors.403', [], 403);
          }
    }

    public function view()
    {
        $features = HelpCenterFeature::all();
        return view('website.forms.help-center.feature',compact('features'));
    }

    public function search(Request $request)
  {
          $title = $request->input('title');
          $courses = HelpCenterFeature::search($title)->get();
          if (!$courses->isEmpty()) {
            return response()->json(['status' => 200, 'data' => $courses]);
        } else {
          
            return response()->json(['status' => 404, 'data' => []]);
        }
  }
}
