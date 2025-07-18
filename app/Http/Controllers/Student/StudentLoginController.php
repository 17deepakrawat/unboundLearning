<?php

namespace App\Http\Controllers\Student;

use App\Helpers\Helpers;
use Carbon\Carbon;
use App\Mail\LoginOtpMail;
use App\Models\Otp;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentLoginRequest;
use App\Jobs\LeadAssignmentRulesJob;
use App\Models\Leads\Lead;
use App\Models\Leads\Opportunity;
use App\Models\Leads\OpportunityCustomField;
use App\Models\Settings\Leads\Source;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubSource;
use App\Models\Settings\Leads\SubStage;
use App\Models\Students\Student;
use App\Models\Students\OtpVerification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Services\SMSOtpService;
use App\Services\MailOtpService;
use Illuminate\Support\Facades\Cache;

class StudentLoginController extends Controller
{
  public function create()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('website.forms.signin', ['pageConfigs' => $pageConfigs]);
  }

  public function store(StoreStudentLoginRequest $request)
  {
    try {
      $lead = Lead::where('email', $request->email)->where('can_login', 1)->with(['opportunities'])->first();
      if (!$lead) {
        return back()->withErrors([
          'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
      }

      if (!$lead || !Hash::check($request->password, $lead->password)) {
        return back()->withErrors([
          'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
      }

      Auth::guard('student')->login($lead);
      return redirect('/')->with('success', 'You have successfully logged in!');
    } catch (\Exception $e) {
      return back()->withErrors([
        'error' => 'Something went wrong!',
      ])->onlyInput('email');
    }
  }

  // public function verify_otp(Request $request)
  // {
  //     $validator = Validator::make($request->all(), [
  //         'student_id' => 'required|exists:students,id',
  //         'otp' => 'required|numeric',
  //     ]);

  //     if ($validator->fails()) {
  //         return response()->json($validator->errors(), 422);
  //     }

  //     $student = Student::where('id', $request->student_id)->first();
  //     $otpRecord = OtpVerification::where('student_id', $student->id)
  //         ->where('otp', $request->otp)
  //         ->where('expire_at', '>', Carbon::now())
  //         ->first();

  //     if (!$otpRecord) {
  //       return response()->json([
  //         'status' => 'success',
  //         'message' => "Invalid OTP or OTP has expired.",
  //       ]);
  //         //return response()->json(['message' => 'Invalid OTP or OTP has expired.'], 422);
  //     }

  //     // Delete used OTP
  //     $otpRecord->delete();
  //     $request->session()->regenerate();
  //     // Here, you can log the user in (e.g., create a session or token)
  //     $student = auth()->login($student);
  //     //return response()->json(['message' => 'Logged in successfully.']);
  //     //print_r($student);
  //     // return redirect()->intended(route('student/dashboard', absolute: false));
  //     //return redirect('/student/dashboard');
  //     return redirect()->route('student/dashboard');

  // }


  public function verify_otp(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'student_id' => 'required|exists:lead,id',
      'otp' => 'required|numeric',
    ]);

    $request->validate([
      'otp' => 'required'
    ]);

    $student = Lead::where('id', $request->student_id)->where('can_login', 1)->with('opportunities')->first();
    $otpRecord = OtpVerification::where('student_id', $request->student_id)
      ->where('otp', $request->otp)
      ->where('expire_at', '>', Carbon::now())
      ->first();

    if (!$otpRecord) {
      return response()->json([
        'status' => 'error',
        'message' => "Invalid OTP or OTP has expired.",
      ]);
    }

    // Delete used OTP
    $otpRecord->delete();
    $request->session()->regenerate();
    // Log the student in
    Auth::guard('student')->login($student);

    // Regenerate session to prevent session fixation

    return response()->json([
      'status' => 'success',
      'message' => 'Logged in successfully.',
      'redirect' => route('student.dashboard')
    ]);
  }



  public function verifyotp(request $request)
  {

    $request->validate([
      'student_id' => 'required|exists:students,id',
      'otp' => 'required'
    ]);
    #Validation Logic
    $verificationCode   = OtpVerification::where('student_id', $request->student_id)->where('otp', $request->otp)->first();
    //print_r($verificationCode);
    $now = Carbon::now()->timezone("Asia/Kolkata");
    if (!$verificationCode) {
      return response()->json([
        'status' => 'success',
        'message' => "Your OTP is not correct",
      ]);
    } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
      return response()->json([
        'status' => 'success',
        'message' => "Your OTP has been expired",
      ]);
    }

    //$student = Student::whereId($request->student_id)->first();
    //   $student = $request->only($request->student_id);
    //   print_r($student);
    // if($student){
    //     // Expire The OTP
    //     $verificationCode->update([
    //         'expire_at' => $now = Carbon::now()->timezone("Asia/Kolkata"),
    //     ]);

    if (Auth::guard('student')->attempt(["id" => $request->student_id])) {
      return redirect()->intended('dashboard');
    }

    return response()->json([
      'status' => 'success',
      'message' => "OTP verified.",
    ]);
    //}

    //return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
  }


  public function generateOTP($email)
  {
    $student = Lead::where('email', $email)->first();
    // $student = Opportunity::findOrFail($student->id);
    # User Does not Have Any Existing OTP
    $verificationCode = OtpVerification::where('student_id', $student->id)->latest()->first();

    $now = Carbon::now()->timezone("Asia/Kolkata");
    if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
      return $verificationCode;
    }

    // Create a New OTP
    return OtpVerification::create([
      'student_id' => $student->id,
      'otp' => rand(123456, 999999),
      'expire_at' => Carbon::now()->timezone("Asia/Kolkata")->addMinutes(5)
    ]);
  }

  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('student')->logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return redirect('/student/login');
  }

  public function forgotPassword()
  {
    return view('website.forms.forgot-password');
  }

  public function forgotPasswordSteps(Request $request, $step)
  {
    $data = array();
    $requestData = $request->all();
    unset($requestData['token']);
    if (count($requestData) > 1) {
      $data = $requestData;
    }

    return view('website.forms.forgot-password.step-' . $step, compact('data'));
  }

  public function forgotPasswordFindEmail(Request $request)
  {
    $validate = $request->validate(['email' => 'required|email|string']);
    $lead = Lead::where('email', 'like', $request->email)->first();
    if ($lead) {
      $email = Helpers::maskString($lead->email, 1, 10);
      $phone = $lead->country_code . '-' . Helpers::maskString($lead->phone, 2, 2);
      return response()->json(['status' => 'success', 'message' => 'Lead found!', 'email' => $email, 'phone' => $phone, 'leadId' => $lead->id]);
    } else {
      return response()->json(['status' => 'error', 'message' => 'Account with this email not found!', 'title' => 'Warning']);
    }
  }

  public function forgotPasswordSendOTP(Request $request, SMSOtpService $smsOtpService, MailOtpService $mailOtpService)
  {
    $validate = $request->validate(['leadId' => 'required|exists:leads,id', 'sendTo' => 'required|string']);
    $lead = Lead::find($validate['leadId']);
    if ($lead) {
      $otp = rand(100000, 999999);
      if ($validate['sendTo'] == 'email') {
        $otpSentOnMail = $mailOtpService->sendOtp($lead->email, $lead->id, $otp);
        $message = "Please enter the code we just sent to email " . Helpers::maskString($lead->email, 1, 10);
      } elseif ($validate['sendTo'] == 'phone') {
        $otpSentOnSMS = $smsOtpService->sendOtp($lead->phone, $lead->country_code, $lead->id, $otp);
         $message = "Please enter the code we just sent to phone " . "<span class='verify_code_t'>". $lead->country_code . '-' .Helpers::maskString($lead->phone, 2, 2)."</span>";
      }

      return response()->json(['status' => 'success', 'message' => $message, 'otp' => $otp, 'leadId' => $lead->id, 'title' => 'Success']);
    } else {
      return response()->json(['status' => 'error', 'message' => 'Account with this leadId not found!', 'title' => 'Warning']);
    }
  }

  public function forgotPasswordVerifyOTP(Request $request)
  {
    // Validate the request
    $validate = $request->validate([
      'leadId' => 'required|exists:leads,id',
      'otp' => 'required|digits:6', // Ensure it's a 6-digit number
    ]);

    try {
      $leadId = $validate['leadId'];
      $providedOtp = $validate['otp'];

      // Retrieve OTP from cache
      $storedOtp = Cache::get('otp_' . $leadId);

      if (!$storedOtp) {
        return response()->json([
          'status' => 'error',
          'isOtpVerification' => true,
          'message' => 'OTP expired or not found.',
          'title' => 'Warning'
        ]);
      }

      if ($storedOtp == $providedOtp) {
        // OTP is valid, clear it from the cache
        Cache::forget('otp_' . $leadId);

        return response()->json([
          'status' => 'success',
          'isOtpVerification' => true,
          'message' => 'OTP verified successfully!',
          'leadId' => $leadId
        ]);
      }

      return response()->json([
        'status' => 'error',
        'isOtpVerification' => true,
        'message' => 'Invalid OTP.',
        'title' => 'Warning'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => false,
        'isOtpVerification' => true,
        'message' => 'Something went wrong: ' . $e->getMessage(),
        'title' => 'Error'
      ]);
    }
  }

  public function forgotPasswordChangePassword(Request $request)
  {
    $validate = $request->validate([
      'leadId' => 'required|exists:leads,id',
      'password' => 'nullable|string|min:8|confirmed',
      'password_confirmation' => 'required|string',
    ]);

    $lead = Lead::find($request->leadId);
    if ($lead) {
      if ($request->password) {
        $lead->password = Hash::make($request->password);
        $lead->save();
        return response()->json(['status' => 'success', 'message' => 'Password changed successfully!', 'title' => 'Success']);
      } else {
        return response()->json(['status' => 'error', 'message' => 'Please provide a password.', 'title' => 'Warning']);
      }
    } else {
      return response()->json(['status' => false, 'message' => 'Account not found.']);
    }
  }

  public function signUp(Request $request)
  {
    $name = $request->name??"";
    $email = $request->email??"";
    return view('website.forms.signup',compact('email','name'));
    // return view('website.forms.signup');
  }

  public function signUpSteps(Request $request, $step, SMSOtpService $smsOtpService, MailOtpService $mailOtpService)
  {
    if ($step == 1) {
      $validate = $request->validate([
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'password' => 'required|string|confirmed',
        'password_confirmation' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'country_code' => 'required|string',
        'gender' => 'required|string',
      ]);

      try {
        $leadWithEmail = Lead::where('email', $validate['email'])->first();
        $leadWithPhone = Lead::where('phone', $validate['phone'])->first();
        
        if ($leadWithPhone || $leadWithEmail) {
          return response()->json(array('status' => 'already', 'title' => 'Warning', 'message' => 'Email or Phone already exists! Try Sign-In'));
        }

        // Stage
        $stage = Stage::where('is_initial', 1)->first();
        $subStage = SubStage::where('stage_id', $stage->id)->first();

        // Source
        $source = Source::where('name', 'Sign-Up')->first();
        if (!$source) {
          $source = Source::create(['name' => 'Sign-Up']);
        }

        // Sub Source
        $subSource = SubSource::where('source_id', $source->id)->where('name', 'Sign Up Form')->first();
        if (!$subSource) {
          $subSource = SubSource::create(['source_id' => $source->id, 'name' => 'Sign Up Form']);
        }

        $request->request->add(['source_id' => $source->id, 'sub_source_id' => $subSource->id]); //add request

        $owner = User::role('Super Admin')->first();
        $lead = Lead::create([
          'first_name' => $validate['firstName'],
          'last_name' => $validate['lastName'],
          'email' => $validate['email'],
          'phone' => $validate['phone'],
          'country_code' => $validate['country_code'],
          'gender' => $validate['gender'],
          'password' => Hash::make($validate['password']),
          'stage_id' => $stage->id,
          'source_id' => $source->id,
          'sub_source_id' => $subSource->id,
          'stage_id' => $stage->id,
          'sub_stage_id' => $subStage->id,
          'user_id' => $owner->id,
          'email_verified_on' => Carbon::now(),
        ]);

        $leadId = $lead->id;
        $otpSentOnSMS = $otpSentOnMail = false;
        $otp = rand(100000, 999999);
        $otpSentOnSMS = $smsOtpService->sendOtp($validate['phone'], $validate['country_code'], $leadId, $otp);
        $otpSentOnMail = $mailOtpService->sendOtp($validate['email'], $leadId, $otp);
        LeadAssignmentRulesJob::dispatch($request->all(), $lead->id);
        return response()->json(['status' => 'success', 'message' => 'Enquiry submitted successfully!', 'otp' => $otp, 'otpRequired' => true, 'leadId' => $leadId, 'otpSentOnSMS' => $otpSentOnSMS, 'otpSentOnMail' => $otpSentOnMail, 'title' => 'Success']);
      } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'title' => 'Error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
      }
    } elseif ($step == 2) {
      $validate = $request->validate([
        'leadId' => 'required|exists:leads,id',
        'country_id' => 'required|exists:countries,id',
        'state_id' => 'required|exists:states,id',
        'city_id' => 'required|exists:cities,id',
        'last_qualification' => 'required|string'
      ]);

      try {
        $lead = Lead::find($validate['leadId']);
        $lead->country_id = $validate['country_id'];
        $lead->state_id = $validate['state_id'];
        $lead->city_id = $validate['city_id'];
        $lead->last_qualification = $validate['last_qualification'];
        $lead->can_login = 1;
        $lead->save();
        $student = Lead::where('id', $lead->id)->where('can_login', 1)->with('opportunities')->first();
        if ($student) {
          Auth::guard('student')->login($student);
        }
        return response()->json(['status' => 'success', 'title' => 'Success', 'message' => 'Welcome ' . $lead->first_name, 'url' => '/']);
      } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'title' => 'Error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
      }
    }
  }
}
