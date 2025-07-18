<?php

namespace App\Services;

use App\Mail\SendOtpMail;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class MailOtpService
{
  public function sendOtp($email, $leadId, $otp)
  {
    try {
      // Send the OTP email
      Mail::to($email)->send(new SendOtpMail($otp));
      Cache::put('otp_' . $leadId, $otp, now()->addMinutes(5));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }
}
