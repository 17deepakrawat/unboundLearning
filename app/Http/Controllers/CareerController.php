<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerTestimonial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CareerController extends Controller
{
  public function index()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view website-career')) {
      if (request()->ajax()) {
        $data = Career::orderBy('id', 'desc')->get();
        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
          })
          ->make(true);
      }
      return view('website.content.career.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    return view('website.content.career.create');
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create website-career')) {
      try {
        $store = Career::create($request->all());
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
    $vacancy = Career::findOrFail($id);
    return view('website.content.career.edit', compact('vacancy'));
  }

  public function update(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit website-career')) {
      try {
        $request->request->remove('_method');
        $request->request->remove('_token');
        $store = Career::where('id', $id)->update($request->all());
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

  public function view(Request $request)
  {
    $pageConfigs = ['myLayout' => 'front'];
    $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->get();
    if ($request->location != null && $request->position != null) {
      $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->whereLike('name', "%$request->position%")->whereLike('city', "%$request->location%")->get();
    } else if ($request->location != null) {
      $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->whereLike('city', "%$request->location%")->get();
    } else if ($request->position != null) {
      $allVacancies = Career::where('status', 1)->where('no_of_vacancy', '>', 0)->whereLike('name', "%$request->position%")->get();
    }
    $locations = Career::pluck('city');
    $testimonials = CareerTestimonial::all();
    return view('website.forms.career', compact('locations', 'allVacancies', 'pageConfigs','testimonials'));
  }
}
