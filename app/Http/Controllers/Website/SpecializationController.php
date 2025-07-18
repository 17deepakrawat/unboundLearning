<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Academics\Specialization;
use Exception;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
  public function view($slug)
  {
    try{
      $pageConfigs = ['myLayout' => 'front'];
      $specialization = Specialization::where('slug', $slug)->with('program', 'programType', 'department', 'mode', 'constantFees')->first();
      
      $verticalKey = [];
      $vertical = [];
      foreach( $specialization->constantFees as $key => $value ) {
            if(!in_array($value->vertical->id,$verticalKey))
            {
              $vertical[] = $value->vertical;
              $verticalKey[] = $value->vertical->id;
            }
      }
      return view('website.specializations.view', ['pageConfigs' => $pageConfigs, 'specialization' => $specialization,'verticals'=>$vertical]);
    }
    catch(Exception $e)
    {
      return response()->view('errors.404', [], 404);
    }
  }
}
