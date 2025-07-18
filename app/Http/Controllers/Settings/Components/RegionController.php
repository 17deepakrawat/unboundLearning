<?php

namespace App\Http\Controllers\Settings\Components;

use App\Http\Controllers\Controller;
use App\Models\Settings\Components\City;
use App\Models\Settings\Components\Country;
use App\Models\Settings\Components\State;
use Illuminate\Http\Request;

class RegionController extends Controller
{
  public function countries()
  {
    try {
      $countries = Country::all();
      return response()->json([
        'status' => 'success',
        'data' => $countries
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong!',
      ]);
    }
  }

  public function states($countryId)
  {
    try {
      $states = State::where('country_id', $countryId)->get();
      return response()->json([
        'status' => 'success',
        'data' => $states
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong!',
      ]);
    }
  }

  public function cities($stateId)
  {
    try {
      $cities = City::where('state_id', $stateId)->get();
      return response()->json([
        'status' => 'success',
        'data' => $cities
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong!',
      ]);
    }
  }
}
