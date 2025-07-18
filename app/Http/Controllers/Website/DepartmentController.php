<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academics\Department;
use Exception;

class DepartmentController extends Controller
{
  public function view(Request $request)
  {
    try{
      $verticals = array();
      $pageConfigs = ['myLayout' => 'front'];
      $department = Department::where('slug', $request->slug)->with(['programTypes', 'verticals', 'programs'])->first();
      $otherDepartments = Department::where('slug', '!=', $request->slug)->with(['programTypes', 'verticals', 'programs'])->get();
      return view('website.departments.view', ['pageConfigs' => $pageConfigs, 'department' => $department, 'otherDepartments' => $otherDepartments]);
    }catch(Exception $e)
    {
      return response()->view('errors.404', [], 404);
    }
  }
}
