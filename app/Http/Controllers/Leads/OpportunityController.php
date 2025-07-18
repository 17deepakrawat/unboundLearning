<?php

namespace App\Http\Controllers\Leads;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMailOnOpportunity;
use App\Models\Academics\ConstantFee;
use App\Models\Academics\Program;
use App\Models\Academics\Specialization;
use App\Models\Academics\Vertical;
use App\Models\Account\OpportunityLedger;
use App\Models\Account\Payment;
use App\Models\Account\Wallet;
use App\Models\Account\WalletTransaction;
use App\Models\Leads\Lead;
use App\Models\Leads\Opportunity;
use App\Models\Leads\OpportunityCustomField;
use App\Models\Leads\OpportunityTask;
use App\Models\Settings\Leads\CustomField;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubStage;
use App\Models\Settings\Leads\Task;
use App\Models\User\UserSharing;
use App\Models\User\UserSharingFee;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class OpportunityController extends Controller
{

  public function index(Request $request)
  {
    $leadId = $request->leadId;
    if (Auth::check() && Auth::user()->hasPermissionTo('view applications')) {
      $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);
      $data = Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
        return $query->whereIn('user_id', $downline);
      })->with(['vertical', 'program', 'specialization'])->where('lead_id', $leadId)->orderBy('id', 'desc');
      return DataTables::of($data)->make(true);
    }
  }

  public function create($leadId)
  {
    $lead = Lead::find($leadId);
    $userId = Auth::user()->id;
    $assignedVertical = UserSharing::where('user_id', $userId)->pluck('vertical_id')->toArray();
    $verticals = Auth::user()->hasRole('Super Admin') ? Vertical::where('is_active', true)->get() : Vertical::where('is_active', true)->whereIn('id', $assignedVertical)->get();
    return view('opportunities.create', compact('lead', 'verticals', 'assignedVertical'));
  }

  public function edit($id)
  {
    $userId = Auth::user()->id;
    $assignedVertical = UserSharing::where('user_id', $userId)->pluck('vertical_id')->toArray();
    $opportunity = Opportunity::find($id)->with('lead')->first();
    $verticals = Auth::user()->hasRole('Super Admin') ? Vertical::where('is_active', true)->get() : Vertical::where('is_active', true)->whereIn('id', $assignedVertical)->get();
    return view('opportunities.edit', compact('opportunity', 'verticals'));
  }

  public function store(Request $request, $id)
  {
    $validate = $request->validate([
      'vertical_id' => 'required|exists:verticals,id',
      'program_id' => 'required|exists:programs,id',
      'specialization_id' => 'required|exists:specializations,id',
      'email' => 'required|email',
      'phone' => 'required|string',
      'country_code' => 'required|string',
      'name' => 'required|string',
      'date_of_birth' => 'required|date',
    ]);

    try {
      $lead = Lead::find($id);
      if (!$lead) {
        throw new Exception('Lead not found!');
      }

      // Email and Phone Check
      $checkEmail = Lead::where('email', 'LIKE', $validate['email'])->where('id', '!=', $lead->id)->first();
      if ($checkEmail) {
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this email already exists!',
        ]);
      }

      $checkPhone = Lead::where('phone', 'LIKE', $validate['phone'])->where('country_code', 'LIKE', $validate['country_code'])->where('id', '!=', $lead->id)->first();
      if ($checkPhone) {
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this phone already exists!',
        ]);
      }

      // Duplicacy Rule
      $specialization = Specialization::with('programType')->where('id', $validate['specialization_id'])->first();
      if ($specialization->programType->is_skill) {
        // On Specialization
        $opportunity = Opportunity::where('lead_id', $lead->id)->where('vertical_id', $validate['vertical_id'])->where('program_id', $validate['program_id'])->where('specialization_id', $validate['specialization_id'])->first();
      } else {
        // on Program
        $opportunity = Opportunity::where('lead_id', $lead->id)->where('vertical_id', $validate['vertical_id'])->where('program_id', $validate['program_id'])->first();
      }

      if ($opportunity) {
        return response()->json(['status' => 'error', 'message' => 'Opportunity already exists for this lead.']);
      }

      $stage = Stage::where('is_initial', 1)->first();
      $subStage = SubStage::where('stage_id', $stage->id)->first();
      $studentId = Helpers::generateStudentId($validate['vertical_id']);

      $data['lead_id'] = $lead->id;
      $data['vertical_id'] = $validate['vertical_id'];
      $data['program_id'] = $validate['program_id'];
      $data['specialization_id'] = $validate['specialization_id'];
      $data['name'] = $validate['name'];
      $data['email'] = $validate['email'];
      $data['phone'] = $validate['phone'];
      $data['country_code'] = $validate['country_code'];
      $data['stage_id'] = $stage->id;
      $data['sub_stage_id'] = $subStage->id;
      $data['user_id'] = $lead->user_id;

      if (!empty($studentId)) {
        $data['student_id'] = $studentId;
      }
      $opportunity = Opportunity::create($data);

      $lead->date_of_birth = date('Y-m-d', strtotime($validate['date_of_birth']));
      $lead->save();

      return response()->json(['status' => 'success', 'message' => 'Opportunity created successfully!']);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function update(Request $request, $id)
  {
    $validate = $request->validate([
      'vertical_id' => 'required|exists:verticals,id',
      'program_id' => 'required|exists:programs,id',
      'specialization_id' => 'required|exists:specializations,id',
      'email' => 'required|email',
      'phone' => 'required|string',
      'country_code' => 'required|string',
      'name' => 'required|string',
      'date_of_birth' => 'required|date',
    ]);

    try {
      $opportunity = Opportunity::find($id);
      $opportunity->update($validate);
      $lead = Lead::find($opportunity->lead_id);
      $lead->date_of_birth = date('Y-m-d', strtotime($validate['date_of_birth']));
      $lead->save();
      return response()->json(['status' => 'success', 'message' => 'Opportunity updated successfully!']);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function view($id)
  {
    $opportunity = Opportunity::where('id', $id)->with(['lead', 'vertical', 'program', 'specialization', 'subStage', 'stage', 'user', 'applicationOwner', 'studentStatus', 'admissionType', 'admissionSession', 'opportunityCustomFields'])->first();
    $customFields = CustomField::where('use_for', 'opportunity')->where('type', '!=', 'File')->pluck('name', 'schema')->toArray();

    $constantFees = ConstantFee::where('scheme_id', $opportunity->scheme_id)->where('specialization_id', $opportunity->specialization_id)->where('vertical_id', $opportunity->vertical_id)->with('feeStructure')->get();
    $conversionDate = $opportunity->conversion_date ? Carbon::createFromFormat('Y-m-d H:i:s', $opportunity->conversion_date)->format('Y-m-d') : '';
    $userSharing = UserSharing::where('user_id', $opportunity->application_owner_id)->where('admission_session_id', $opportunity->admission_session_id)->where('start_date', '<=', $conversionDate)->orderBy('id', 'asc')->first();
    $userSharingFees = array();
    if ($userSharing) {
      $userSharingFees = UserSharingFee::where('user_sharing_id', $userSharing->id)->where('scheme_id', $opportunity->scheme_id)->where('specialization_id', $opportunity->specialization_id)->with('feeStructure')->get()->toArray();
    }
    $sharingFees = array();
    foreach ($userSharingFees as $userSharingFee) {
      $sharingFees[$userSharingFee['duration']][$userSharingFee['fee_structure_id']] = $userSharingFee['fee'];
    }
    $payments = Payment::where('opportunity_id', $opportunity->id)->where('type', 'offline')->where('status', 0)->get();
    $opportunityLedgers = OpportunityLedger::where('opportunity_id', $opportunity->id)->get();

    $paidPayments = array();
    $showOnlyFull = true;
    $showOtherThanFull = true;
    $selectedDurationsSemester = array();
    $selectedDurationsAnnual = array();
    $feeTypes = array_unique($constantFees->pluck('fee_type')->toArray());
    if ($opportunityLedgers->count() > 0) {
      foreach ($opportunityLedgers as $opportunityLedger) {
        if ($opportunityLedger->payment_type == 'Full') {
          $showOtherThanFull = false;
          break;
        } else {
          $showOnlyFull = false;
          break;
        }
      }

      if ($showOnlyFull) {
        $opportunityLedgers = OpportunityLedger::where('opportunity_id', $opportunity->id)->with('payment', 'walletTransaction')->where('payment_type', 'Full')->first();
        $paidPayments['Full'][] = $opportunityLedgers->toArray();
      } else {
        $opportunityLedgers = OpportunityLedger::where('opportunity_id', $opportunity->id)->with('payment', 'walletTransaction')->where('payment_type', '!=', 'Full')->get();
        foreach ($opportunityLedgers as $opportunityLedger) {
          $paidPayments[$opportunityLedger->payment_type][] = $opportunityLedger->toArray();
          if ($opportunityLedger->payment_type == 'Semester') {
            $selectedDurationsSemester[] = $opportunityLedger->duration;
          } elseif ($opportunityLedger->payment_type == 'Annual') {
            $selectedDurationsAnnual[] = $opportunityLedger->duration;
          }
        }
      }
    }

    foreach ($feeTypes as $key => $feeType) {
      if ($feeType != 'Full' && $showOnlyFull && !empty($paidPayments)) {
        unset($feeTypes[$key]);
      }
      if ($feeType == 'Full' && $showOtherThanFull && !empty($paidPayments)) {
        unset($feeTypes[$key]);
      }
    }
    return view('opportunities.view', compact('opportunity', 'constantFees', 'sharingFees', 'payments', 'showOnlyFull', 'showOtherThanFull', 'paidPayments', 'feeTypes', 'selectedDurationsSemester', 'selectedDurationsAnnual', 'customFields'));
  }

  public function delete($id)
  {
    $opportunity = Opportunity::find($id);
    $deleteOpportunityCustomFields = OpportunityCustomField::where('opportunity_id', $opportunity->id)->get();
    foreach ($deleteOpportunityCustomFields as $deleteOpportunityCustomField) {
      $deleteOpportunityCustomField->delete();
    }
    $deleteOpportunityTasks = OpportunityTask::where('opportunity_id', $opportunity->id)->get();
    foreach ($deleteOpportunityTasks as $deleteOpportunityTask) {
      $deleteOpportunityTask->delete();
    }
    $deleteOpportunityLedgers = OpportunityLedger::where('opportunity_id', $opportunity->id)->get();
    foreach ($deleteOpportunityLedgers as $deleteOpportunityLedger) {
      $deleteOpportunityLedger->delete();
    }
    $opportunity->delete();
    return redirect()->back()->with('success', 'Opportunity deleted successfully!');
  }

  public function payment(Request $request, $id)
  {
    $validate = $request->validate([
      'feeType' => 'required|string',
      'semesters' => 'nullable|array',
      'annuals' => 'nullable|array',
    ]);

    $opportunity = Opportunity::find($id);
    $constantFees = ConstantFee::where('scheme_id', $opportunity->scheme_id)->where('specialization_id', $opportunity->specialization_id)->where('vertical_id', $opportunity->vertical_id)->with('feeStructure')->get();
    $conversionDate = $opportunity->conversion_date ? Carbon::createFromFormat('Y-m-d H:i:s', $opportunity->conversion_date)->format('Y-m-d') : '';
    $userSharing = UserSharing::where('user_id', $opportunity->application_owner_id)->where('admission_session_id', $opportunity->admission_session_id)->where('start_date', '<=', $conversionDate)->orderBy('id', 'asc')->first();
    $userSharingFees = array();
    if ($userSharing) {
      $userSharingFees = UserSharingFee::where('user_sharing_id', $userSharing->id)->where('scheme_id', $opportunity->scheme_id)->where('specialization_id', $opportunity->specialization_id)->with('feeStructure')->get()->toArray();
    }
    $sharingFees = array();
    foreach ($userSharingFees as $userSharingFee) {
      $sharingFees[$userSharingFee['duration']][$userSharingFee['fee_structure_id']] = $userSharingFee['fee'];
    }

    $totalAmount = array();
    $totalPayables = array();
    $totalAmountOnDurations = array();
    $selectedDurations = $validate['feeType'] == 'Semester' ? $validate['semesters'] : ($validate['feeType'] == 'Annual' ? $validate['annuals'] : []);
    if ($validate['feeType'] == 'Full') {
      foreach ($constantFees as $constantFee) {
        if ($constantFee->fee_type == $validate['feeType']) {
          if (empty($constantFee->admission_type_id) || (!empty($constantFee->admission_type_id) && $constantFee->admission_type_id == $opportunity->admission_type_id)) {
            $fee = $constantFee->fee;
            if ($constantFee->feeStructure->has_sharing && array_key_exists($constantFee->feeStructure->id, $sharingFees[1])) {
              $fee = ((100 - $sharingFees[1][$constantFee->feeStructure->id]) * $fee) / 100;
              $sharingPercent = $sharingFees[1][$constantFee->feeStructure->id];
            }
            $totalAmount[] = $fee;
          }
        }
      }
    } elseif (in_array($validate['feeType'], ['Semester', 'Annual'])) {
      foreach ($selectedDurations as $selectedDuration) {
        foreach ($constantFees as $constantFee) {
          if ($constantFee->fee_type == $validate['feeType']) {
            if (empty($constantFee->admission_type_id) || (!empty($constantFee->admission_type_id) && $constantFee->admission_type_id == $opportunity->admission_type_id)) {
              $duration = empty($constantFee->duration) ? $opportunity->admission_duration : $constantFee->duration;
              if ($duration == $selectedDuration) {
                $totalPayables[$duration][$constantFee->feeStructure->id] = $constantFee->fee;
                if ($constantFee->feeStructure->has_sharing && array_key_exists($constantFee->feeStructure->id, $sharingFees[$duration])) {
                  $fee = ((100 - $sharingFees[1][$constantFee->feeStructure->id]) * $constantFee->fee) / 100;
                  $totalPayables[$duration][$constantFee->feeStructure->id] = $fee;
                }
              }
            }
          }
        }
      }


      foreach ($totalPayables as $duration => $payables) {
        $totalAmount[] = array_sum($payables);
        $totalAmountOnDurations[$duration] = array_sum($payables);
      }
    }
    $totalAmount = array_sum($totalAmount);
    $opportunityId = $opportunity->id;
    $feeType = $validate['feeType'];
    return view('opportunities.payment.create', compact('opportunityId', 'totalAmount', 'feeType', 'selectedDurations', 'totalAmountOnDurations'));
  }

  public function paymentMethod(Request $request, $id)
  {
    $validate = $request->validate([
      'payment_method' => 'required|string',
      'totalAmount' => 'required|numeric',
      'feeType' => 'required|string',
      'selectedDurations' => 'nullable|string',
      'totalAmountOnDurations' => 'required|string',
    ]);

    $opportunity = Opportunity::find($id);
    $totalAmount = $validate['totalAmount'];
    $feeType = $validate['feeType'];
    $selectedDurations = explode(',', $validate['selectedDurations']);
    $totalAmountOnDurations = $validate['totalAmountOnDurations'];
    $vertical = Vertical::find($opportunity->vertical_id);
    $verticalMetaData = !empty($vertical->metadata) ? json_decode($vertical->metadata, true) : [];

    if ($validate['payment_method'] == 'offline') {
      return view('opportunities.payment.methods.offline', compact('opportunity', 'totalAmount', 'feeType', 'selectedDurations', 'verticalMetaData', 'totalAmountOnDurations'));
    } elseif ($validate['payment_method'] == 'wallet') {
      // Get Wallet Balance
      $walletBalance = 0;
      $wallet = Wallet::where('user_id', $opportunity->application_owner_id)->where('vertical_id', $opportunity->vertical_id)->first();
      if ($wallet) {
        $walletBalance = WalletTransaction::where('wallet_id', $wallet->id)->get()
          ->sum(fn($transaction) => $transaction->type === 'deposit'
          ? $transaction->amount
            : -$transaction->amount);
      }

      return view('opportunities.payment.methods.wallet', compact('opportunity', 'totalAmount', 'feeType', 'selectedDurations', 'verticalMetaData', 'totalAmountOnDurations', 'walletBalance'));
    }
  }

  public function sendToUniversity(Request $request, $id)
  {
    if (!Auth::user()->hasPermissionTo('send-data-to-university applications')) {
      return response()->json(['status' => 'error', 'message' => 'You are not authorized to send data to university.']);
    }

    $opportunity = Opportunity::where('id', $id)->with(['lead', 'vertical', 'program', 'specialization', 'subStage', 'stage', 'scheme', 'user', 'applicationOwner', 'studentStatus', 'admissionType', 'admissionSession', 'opportunityCustomFields', 'opportunityLedger'])->first();
    $customFields = CustomField::where('use_for', 'opportunity')->pluck('type', 'schema')->toArray();

    $verticalConfiguration = $opportunity->vertical->metadata;
    $configurations = !empty($verticalConfiguration) ? json_decode($verticalConfiguration, true) : [];
    if (!empty($verticalConfiguration) && array_key_exists('university_endpoint_url', $configurations) && !empty($configurations['university_endpoint_url'])) {
      $endPointUrl = $configurations['university_endpoint_url'];
      $universityHeader = !empty($configurations['university_header']) ? $configurations['university_header'] : [];

      if (!empty($universityHeader)) {
        $universityHeader = explode('\r\n', $universityHeader);
        $universityHeader = array_filter($universityHeader, function ($item) {
          return !empty($item);
        });
        $universityHeader = array_map(function ($item) {
          $item = explode(':', $item);
          return [trim($item[0]) => trim($item[1])];
        }, $universityHeader);
      }
      $payments = array();
      foreach ($opportunity->opportunityLedger as $opportunityLedgerData) {
        foreach ($opportunityLedgerData->toArray() as $key => $opportunityLedger) {
          if (strpos($key, 'id') === false) {
            if ($key == 'payment' && is_array($opportunityLedger)) {
              foreach ($opportunityLedger as $paymentKey => $paymentValue) {
                if (strpos($paymentKey, 'id') === false) {
                  $paymentValue = $paymentKey == 'meta' ? json_decode($paymentValue, true) : $paymentValue;
                  $paymentValue = $paymentKey == 'file' && !empty($paymentValue) ? json_decode($paymentValue, true) : $paymentValue;
                  $paymentValue = $paymentKey == 'approved_by' && !empty($paymentValue) ? json_decode($paymentValue, true) : $paymentValue;
                  $payments['payment_transactions'][$paymentKey] = $paymentValue;
                }
              }
            } elseif ($key == 'wallet_transaction' && is_array($opportunityLedger)) {
              foreach ($opportunityLedger as $walletTransactionKey => $walletTransactionValue) {
                if (strpos($walletTransactionKey, 'id') === false) {
                  $walletTransactionValue = $walletTransactionKey == 'meta' ? json_decode($walletTransactionValue, true) : $walletTransactionValue;
                  $payments['wallet_transactions'][$walletTransactionKey] = $walletTransactionValue;
                }
              }
            } else {
              $payments[$key] = $opportunityLedger;
            }
          }
        }
      }

      $data = [
        'opportunity_id' => $opportunity->id,
        'lead' => $opportunity->lead,
        'name' => $opportunity->name,
        'email' => $opportunity->email,
        'country_code' => $opportunity->country_code,
        'phone' => $opportunity->phone,
        'date_of_birth' => $opportunity->lead?->date_of_birth,
        'gender' => $opportunity->lead?->gender,
        'country' => $opportunity->lead?->country?->name,
        'state' => $opportunity->lead?->state?->name,
        'city' => $opportunity->lead?->city?->name,
        'address' => $opportunity->lead?->address,
        'zip_code' => $opportunity->lead?->zip_code,
        'program_type' => $opportunity->specialization->programType?->name,
        'program' => $opportunity->program?->name,
        'specialization' => $opportunity->specialization?->name,
        'vertical' => $opportunity->vertical?->name,
        'student_id' => $opportunity->student_id,
        'admission_type' => $opportunity->admissionType?->name,
        'admission_session' => $opportunity->admissionSession?->name,
        'student_status' => $opportunity->studentStatus?->name,
        'admission_duration' => $opportunity->admission_duration,
        'scheme' => $opportunity->scheme?->name,
        'conversion_date' => $opportunity->conversion_date,
        'user_name' => $opportunity->user?->name,
        'user_email' => $opportunity->user?->email,
        'owner_name' => $opportunity->applicationOwner?->name,
        'owner_email' => $opportunity->applicationOwner?->email,
        'payments' => $payments,
      ];

      $customFieldsData = $opportunity->opportunityCustomFields->toArray();
      if (array_key_exists(0, $customFieldsData) && !empty($customFieldsData[0])) {
        foreach ($customFieldsData[0] as $key => $value) {
          if (!in_array($key, ['id', 'opportunity_id', 'created_at', 'updated_at']) && array_key_exists($key, $customFields)) {
            if ($customFields[$key] == 'Date') {
              $data[$key] = date('Y-m-d', strtotime($value));
            } elseif ($customFields[$key] == 'Number') {
              $data[$key] = (int) $value;
            } elseif ($customFields[$key] == 'File') {
              $files = json_decode($value, true);
              if ($files) {
                foreach ($files as $file) {
                  $file = public_path($file);
                  $data[$key]['base64Encoded'] = base64_encode(file_get_contents($file));
                  $data[$key]['url'] = env('APP_URL') . str_replace(public_path(), '', $file);
                }
              }
            } else {
              // check value is json encoded
              if (is_string($value) && json_decode($value)) {
                $data[$key] = json_decode($value, true);
              } else {
                $data[$key] = $value;
              }
            }
          }
        }
      }
      // sortbykey
      ksort($data);

      // Check Header contains Content-Type: application/json
      $contentType = array_filter($universityHeader, function ($item) {
        return array_key_exists('Content-Type', $item);
      });
      if (empty($contentType)) {
        $universityHeader[] = 'Content-Type: application/json';
      }

      $ch = curl_init($endPointUrl);
      // Set cURL options
      curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $universityHeader
      ]);
      $response = curl_exec($ch);
      if (curl_errno($ch)) {
        throw new \Exception(curl_error($ch));
      }
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      if (in_array($httpCode, [200, 201])) {
        return response()->json(['status' => 'success', 'message' => 'Data sent to university successfully!']);
      } else {
        return response()->json(['status' => 'error', 'message' => 'Failed to send data to university!']);
      }
    } else {
      return response()->json(['status' => 'error', 'message' => 'University endpoint url is not configured!']);
    }
  }

  public function sendWelcomeEmail(Request $request, $id)
  {
    $opportunity = Opportunity::find($id);
    if ($opportunity) {
      // send welcome email to the opportunity
      $student = [
        'name' => $opportunity->name,
        'vertical' => $opportunity->vertical->name,
        'program' => $opportunity->program->short_name . ' (' . $opportunity->specialization->name . ')',
        'student_id' => $opportunity->student_id,
      ];

      Mail::to($opportunity->email)->send(new WelcomeMailOnOpportunity($student));
      return response()->json(['status' => 'success', 'message' => 'Welcome email sent successfully!']);
    } else {
      return response()->json(['status' => 'error', 'message' => 'Opportunity not found!']);
    }
  }
}
