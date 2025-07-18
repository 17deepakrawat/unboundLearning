<?php

namespace App\Http\Controllers;

use App\Models\CareerTestimonial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CareerTestimonialController extends Controller
{
    public function index()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view career-testimonial')) {
      $testimonial = CareerTestimonial::all();
      return view('website.content.career.testimonial.index',compact('testimonial'));
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
