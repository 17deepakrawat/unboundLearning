<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Jobs\LeadAssignmentRulesJob;
use App\Models\Leads\Lead;
use App\Models\Leads\Opportunity;
use App\Models\Settings\Leads\Source;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubStage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
  public function redirectToGoogle()
  {
    return Socialite::driver('google')->redirect();
  }

  public function handleGoogleCallback()
  {
    try {
      $googleUser = Socialite::driver('google')->user();

      // $source = Source::where('name', 'Google Sign In')->first();
      // if (!$source) {
      //   $source = Source::create(['name' => 'Google Sign In']);
      // }

      // Stage
      // $stage = Stage::where('is_initial', 1)->first();
      // $subStage = SubStage::where('stage_id', $stage->id)->first();

      // $owner = User::role('Super Admin')->first();
      // Save or update user in the database
      // $lead = Lead::updateOrCreate(
      //   ['email' => $googleUser->email], // Match by email
      //   [
      //     'first_name' => $googleUser->name,
      //     'source_id' => $source->id,
      //     'avatar' => $googleUser->avatar,
      //     'can_login' => 1, // Enable login for this lead
      //     'email_verified_on' => Carbon::now(),
      //     'stage_id' => $stage->id,
      //     'sub_stage_id' => $subStage->id,
      //     'user_id' => $owner->id
      //   ]
      // );

      // $student = Lead::where('id', $lead->id)->where('can_login', 1)->with('opportunities')->first();
      // if ($student) {
      //   Auth::guard('student')->login($student);
      // }

      // Redirect the user to the home page
      // return redirect('/')->with('success', 'You have successfully logged in!');
      return redirect(route('student.sign-up',['name'=>$googleUser->name,'email'=>$googleUser->email]));
    } catch (\Exception $e) {
      return redirect('/student/login')->with('error', 'Something went wrong. Please try again.');
    }
  }
}
