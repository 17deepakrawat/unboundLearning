<?php

namespace App\Http\Controllers;

use App\Models\VerticalTestimonial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class VerticalTestimonialController extends Controller
{
    public function index($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view vertical-testimonial')) {
      // $testimonial = VerticalTestimonial::where('vertical_id',$id)->get();
      if (request()->ajax()) {
        $data = VerticalTestimonial::where('vertical_id',$id)->orderBy('id', 'desc')->get();
        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('website.content.vertical.testimonial.index',compact('id'));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create($id)
  {
    return view('website.content.vertical.testimonial.create',compact('id'));
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create vertical-testimonial')) {
      try {
        $image = '';
        if($request->hasFile('image'))
        {   
            $path = 'assets/vertical/testimonial/images';
            $newFileName = rand() . time() . '.' . $request->image->extension();
            $request->image->move(public_path($path), $newFileName);
            $image = $path . '/' . $newFileName;
        }
        $store = VerticalTestimonial::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'designation'=>$request->designation,
            'image'=>$image,
            'vertical_id' => $request->vertical_id,
        ]);
        return response()->json([
          'status' => 'success',
          'message' => 'Vacancy created successfully!',
        ]);
      } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function edit($id)
  {
    $testimonial = VerticalTestimonial::findOrFail($id);
    return view('website.content.vertical.testimonial.edit', compact('testimonial'));
  }

  public function update(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit vertical-testimonial')) {
      try {
        $request->request->remove('_method');
        $request->request->remove('_token');
        $store = VerticalTestimonial::findOrFail($id);
        $image = $store->image;
        if($request->hasFile('image'))
        {
            $path = 'assets/vertical/testimonial/images';
            $newFileName = rand() . time() . '.' . $request->image->extension();
            $request->image->move(public_path($path), $newFileName);
            $image = $path . '/' . $newFileName;
        }
        $store->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'designation'=>$request->designation,
            'image'=>$image,
        ]);
        return response()->json([
          'status' => 'success',
          'message' => 'Vacancy updated successfully!',
        ]);
      } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }
}
