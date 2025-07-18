<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Academics\ProgramType;
use Exception;
use Illuminate\Http\Request;

class ProgramTypeController extends Controller
{
  public function view(Request $request)
  {
    try{
      $verticals = array();
    $pageConfigs = ['myLayout' => 'front'];
    $programType = ProgramType::where('slug', $request->slug)->with(['programs', 'departments', 'departmentVerticals'])->first();
    $otherProgramTypes = ProgramType::where('slug', '!=', $request->slug)->with(['programs', 'departments', 'departmentVerticals'])->get();
    return view('website.program-types.view', ['pageConfigs' => $pageConfigs, 'programType' => $programType, 'otherProgramTypes' => $otherProgramTypes]);
    }
    catch(Exception $e)
    {
      return response()->view('errors.404', [], 404);
    }
  }
}
