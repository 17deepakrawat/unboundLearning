<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\CareerTestimonial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CareerTestimonialController extends Controller
{
    public function index()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view career-testimonial')) {
      if (request()->ajax()) {
        $data = CareerTestimonial::all();
        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('website.content.career.testimonial.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    return view('website.content.career.testimonial.create');
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create career-testimonial')) {
      try {
        $image = '';
        if($request->hasFile('image'))
        {   
            $path = 'assets/career/testimonial/images';
            $newFileName = rand() . time() . '.' . $request->image->extension();
            $request->image->move(public_path($path), $newFileName);
            $image = $path . '/' . $newFileName;
        }
        $store = CareerTestimonial::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'designation'=>$request->designation,
            'image'=>$image
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
    $testimonial = CareerTestimonial::findOrFail($id);
    return view('website.content.career.testimonial.edit', compact('testimonial'));
  }

  public function update(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit career-testimonial')) {
      try {
        $request->request->remove('_method');
        $request->request->remove('_token');
        $store = CareerTestimonial::findOrFail($id);
        $image = $store->image;
        if($request->hasFile('image'))
        {
            $path = 'assets/career/testimonial/images';
            $newFileName = rand() . time() . '.' . $request->image->extension();
            $request->image->move(public_path($path), $newFileName);
            $image = $path . '/' . $newFileName;
        }
        $store->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'designation'=>$request->designation,
            'image'=>$image
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
