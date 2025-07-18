<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;

class SMSOtpService
{
  public function sendOtp($phone, $countryCode, $leadId, $otp)
  {
    $fullPhone = $countryCode . $phone;

    // Send SMS
    try {
      // $this->sendSms($fullPhone, "Your OTP is: $otp");
      Cache::put('otp_' . $leadId, $otp, now()->addMinutes(5));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  private function sendSms($to, $message)
  {
    $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    $client->messages->create(env('TWILIO_VERIFIED_NUM'), [
      'from' => env('TWILIO_PHONE_NUMBER'),
      'body' => $message,
    ]);
  }
}
