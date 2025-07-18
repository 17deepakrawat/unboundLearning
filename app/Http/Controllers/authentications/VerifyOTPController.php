<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Leads\Lead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class VerifyOTPController extends Controller
{
  public function create($formId, $leadId)
  {
    $actions = array(
      'downloadEBrochureForm' => '/verify-phone-otp',
      'downloadEBrochureForm1' => '/verify-phone-otp',
      'stepOneForm' => '/verify-phone-otp',
      'registerForm' => '/verify-phone-otp',
      'careerForm' => '/verify-phone-otp',
      'forgotPasswordVerifyOTPForm' => '/student/login/forgot-password/otp/verify',
    );

    return view('website.forms.otp.create', ['formId' => $formId, 'leadId' => $leadId, 'action' => $actions[$formId]]);
  }

  public function verifyPhoneOtp(Request $request)
  {
    // Validate the request
    $validate = $request->validate(['leadId' => 'required|exists:leads,id',
      'otp' => 'required|digits:6', // Ensure it's a 6-digit number
    ]);

    try {
      $leadId = $validate['leadId'];
      $providedOtp = $validate['otp'];

      // Retrieve OTP from cache
      $storedOtp = Cache::get('otp_' . $leadId);

      if (!$storedOtp) {
        return response()->json([
          'status' => false,
          'isOtpVerification' => true,
          'message' => 'OTP expired or not found.',
        ]);
      }

      if ($storedOtp == $providedOtp) {
        // OTP is valid, clear it from the cache
        Cache::forget('otp_' . $leadId);

        // Update Lead Status
        $lead = Lead::where('id', $validate['leadId'])->first();
        if ($lead) {
          $lead->phone_verified_on = Carbon::now();
          $lead->save();
        }

        $student = Lead::where('id', $lead->id)->where('can_login', 1)->with('opportunities')->first();
        if ($student) {
          Auth::guard('student')->login($student);
        }

        return response()->json([
          'status' => true,
          'isOtpVerification' => true,
          'message' => 'OTP verified successfully.',
        ]);
      }

      return response()->json([
        'status' => false,
        'isOtpVerification' => true,
        'message' => 'Invalid OTP.',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => false,
        'isOtpVerification' => true,
        'message' => 'Something went wrong: ' . $e->getMessage(),
      ]);
    }
  }
}
