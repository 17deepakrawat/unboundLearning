<?php

namespace App\Http\Controllers\Leads;

use App\Exports\LeadsExport;
use App\Exports\LeadsImportStatusExport;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Settings\Leads\AssignmentRulesController;
use App\Http\Requests\Leads\LeadRequest;
use App\Imports\LeadsImport;
use App\Jobs\LeadAssignmentRulesJob;
use App\Models\Academics\ConstantFee;
use App\Models\Academics\DepartmentVertical;
use App\Models\Academics\Program;
use App\Models\Academics\ProgramTypeDepartmentVertical;
use App\Models\Academics\Specialization;
use App\Models\Academics\Vertical;
use App\Models\Leads\Lead;
use App\Models\Leads\NewsLetterSubscriber;
use App\Models\Leads\Opportunity;
use App\Models\Leads\OpportunityCustomField;
use App\Models\Settings\Leads\CustomField;
use App\Models\Settings\Leads\Source;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubSource;
use App\Models\Settings\Leads\SubStage;
use App\Models\Settings\Leads\Task;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\SMSOtpService;
use App\Services\MailOtpService;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view leads')) {
      if ($request->ajax()) {
        $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);
        $data = Lead::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
          return $query->whereIn('user_id', $downline);
        })->with(['stage', 'source', 'subSource', 'subStage', 'program', 'specialization', 'user'])->orderBy('id', 'desc');
        if (($request->ajax() && isset($request->filter_on) && !empty($request->filter_on)) || session()->has('filterjson')) {
          if (!empty($request->filter_on) && count($request->filter_on) > 0) {
            session()->put('filterjson', ['filter_on' => $request->filter_on, 'filter_type' => $request->filter_type, 'filter_value' => $request->filter_value]);
          }
          $filterJson = session('filterjson');
          if (!empty($filterJson) && $filterJson['filter_on'] != null) {
            for ($i = 0; $i < count($filterJson['filter_on']); $i++) {

              $schema =  $filterJson['filter_on'][$i];
              $value =  is_array($filterJson['filter_value'][$filterJson['filter_on'][$i]]) ? implode(',', $filterJson['filter_value'][$filterJson['filter_on'][$i]]) : $filterJson['filter_value'][$filterJson['filter_on'][$i]];
              if ($filterJson['filter_type'][$i] == 'Equal To') {
                $data = $data->where($schema, $value);
              } elseif ($filterJson['filter_type'][$i] == 'Not Equal To') {
                $data = $data->whereNot($schema, $value);
              } elseif ($filterJson['filter_type'][$i] == 'Less Than') {
                $data = $data->where($schema, '<', $value);
              } elseif ($filterJson['filter_type'][$i] == 'Greater Than') {
                $data = $data->where($schema, '>', $value);
              } elseif ($filterJson['filter_type'][$i] == 'Less or Equal To') {
                $data = $data->where($schema, '<=', $value);
              } elseif ($filterJson['filter_type'][$i] == 'Greater or Equal To') {
                $data = $data->where($schema, '>=', $value);
              } elseif ($filterJson['filter_type'][$i] == 'In') {
                $data = $data->whereIn($schema, $value);
              } elseif ($filterJson['filter_type'][$i] == 'Not In') {
                $data = $data->whereNotIn($schema, $value);
              } elseif ($filterJson['filter_type'][$i] == 'Has Prefix') {
                $data = $data->whereLike($schema, "%$value");
              } elseif ($filterJson['filter_type'][$i] == 'Has Sufix') {
                $data = $data->whereLike($schema, "$value%");
              } elseif ($filterJson['filter_type'][$i] == 'Contains') {
                $data = $data->whereLike($schema, "%$value%");
              } elseif ($filterJson['filter_type'][$i] == 'Not Contains') {
                $data = $data->whereNotLike($schema, "$value%");
              }
            }
          }
        }
        $data = $data->get();
        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
          return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME', 'UTC'))->format('d-m-Y h:i A');
          })->editColumn('updated_at', function ($data) {
          return Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME', 'UTC'))->format('d-m-Y h:i A');
          })
          ->make(true);
      }
      return view('leads.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function newsLetterSubscribers(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view leads')) {
      if ($request->ajax()) {
        $data = NewsLetterSubscriber::orderBy('id', 'desc')->get();
        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
          return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME', 'UTC'))->format('d-m-Y h:i A');
          })->editColumn('updated_at', function ($data) {
          return Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME', 'UTC'))->format('d-m-Y h:i A');
          })
          ->make(true);
      }
      return view('leads.newsletter-subscriber');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    $programs = Program::where('is_active', true)->get();
    $sources = Source::where('is_active', true)->get();
    return view('leads.create', compact(['programs', 'sources']));
  }

  public function store(LeadRequest $request)
  {
    try {
      $stage = Stage::where('is_initial', 1)->first();
      $subStage = SubStage::where('stage_id', $stage->id)->first();

      if (!$subStage) {
        return response()->json([
          'status' => 'error',
          'message' => 'Initial Sub Stage not found!',
        ]);
      }

      // Check
      $leadWithEmail = Lead::where('email', 'LIKE', $request->email)->first();
      $leadWithPhone = Lead::where('phone', $request->phone)->first();

      if ($leadWithEmail && $leadWithPhone) {
        // TODO: Add Re-Enquired Activity
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this email and phone already exists!',
        ]);
      }

      if ($leadWithEmail) {
        // TODO: Add Re-Enquired Activity
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this email already exists!',
        ]);
      }

      if ($leadWithPhone) {
        // TODO: Add Re-Enquired Activity
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this phone already exists!',
        ]);
      }

      $lead = Lead::create([
        'phone' => $request->phone,
        'country_code' => $request->countryCode,
        'email' => $request->email,
        'first_name' => $request->first_name,
        'program_id' => $request->program_id,
        'source_id' => $request->source_id,
        'sub_source_id' => $request->sub_source_id,
        'user_id' => Auth::user()->id,
        'stage_id' => $stage->id,
        'sub_stage_id' => $subStage->id,
        'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d')
      ]);
      return response()->json(['status' => 'success', 'message' => 'Lead created successfully!', 'title' => 'Success']);
    } catch (\Exception $e) {
      $message = strpos($e->getMessage(), 'Duplicate') !== false
        ? 'Lead aleady exists!'
        : $e->getMessage();
      return response()->json([
        'status' => 'error',
        'message' => $message,
      ]);
    }
  }

  public function edit(Request $request, $id)
  {
    $lead = Lead::where('id', $id)->with('program', 'specialization')->first();
    $lead->date_of_birth = $lead->date_of_birth ? Carbon::parse($request->date_of_birth)->format('d-m-Y') : null;
    $programs = Program::all();
    return view('leads.edit', compact('lead', 'programs'));
  }
  public function update(Request $request, $id)
  {
    try {

      // Check
      $leadWithEmail = Lead::where('email', 'LIKE', $request->email)->where('id', '!=', $id)->first();
      $leadWithPhone = Lead::where('phone', $request->phone)->where('id', '!=', $id)->first();

      if ($leadWithEmail && $leadWithPhone) {
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this email and phone already exists!',
        ]);
      }

      if ($leadWithEmail) {
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this email already exists!',
        ]);
      }

      if ($leadWithPhone) {
        return response()->json([
          'status' => 'error',
          'message' => 'Lead with this phone already exists!',
        ]);
      }

      $lead = Lead::where('id', $id)->update([
        'first_name' => $request->first_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'country_code' => $request->countryCode,
        'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
        'program_id' => $request->program_id,
        'specialization_id' => $request->specialization_id
      ]);
      return response()->json([
        'status' => 'success',
        'title' => 'Success',
        'message' => 'Lead updated successfully!',
      ]);
    } catch (\Exception $e) {
      $message = strpos($e->getMessage(), 'Duplicate') !== false
        ? 'Lead aleady exists!'
        : $e->getMessage();
      return response()->json([
        'status' => 'error',
        'message' => $message,
      ]);
    }
  }

  public function view($leadId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view leads')) {
      try {
        $customFields = CustomField::pluck('name', 'schema')->toArray();
        $lead = Lead::where('id', $leadId)->with('source', 'subSource', 'stage', 'subStage', 'program', 'specialization', 'user', 'tasks')->first();
        $tasks = Task::where('is_active', 1)->get();
        return view('leads.view', compact('lead', 'tasks'));
      } catch (\Exception $e) {
        return response()->view('errors.500', [], 500);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }


  public function export()
  {
    return Excel::download(new LeadsExport, 'leads.xlsx');
  }

  public function program(Request $request)
  {
    $verticalId = $request->id;
    $deaprtmentVerticals = DepartmentVertical::where('vertical_id', $verticalId)->with('department', 'programTypes')->get();
    $allotedPrograms = [];
    foreach ($deaprtmentVerticals as $deaprtmentVertical) {
      foreach ($deaprtmentVertical->programTypes as $programType) {
        $programTypeDepartmentVertical = ProgramTypeDepartmentVertical::where('program_type_id', $programType->id)->where('department_vertical_id', $deaprtmentVertical->id)->with('programs', 'programType')->first();
        foreach ($programTypeDepartmentVertical->programs as $program) {
          $allotedPrograms[$program->id]['id'] = $program->id;
          $allotedPrograms[$program->id]['name'] = $program->name;
          $allotedPrograms[$program->id]['slug'] = $program->slug;
          $allotedPrograms[$program->id]['department'] = $programTypeDepartmentVertical->departmentVertical->department->name;
          $allotedPrograms[$program->id]['program_type'] = $programTypeDepartmentVertical->programType->name;
        }
      }
    }
    return json_encode(array('status' => 'success', 'data' => $allotedPrograms));
  }

  public function customOptions($schema, $value, $leadid)
  {
    $fieldId = CustomField::where('schema', $schema)->where('use_for', 'lead')->get('id');
    $customDependents = CustomField::where('dependent', $fieldId[0]->id)->where('use_for', 'lead')->get();
    if ($leadid > 0) {
      $allFieldsData =  OpportunityCustomField::where('lead_id', $leadid)->get();
    }
    if (count($customDependents) > 0) {
      foreach ($customDependents as $customDependent) {
        if (array_key_exists($value, json_decode($customDependent->options, true))) {
          $customOptions = json_decode($customDependent->options, true);
          $optHTML = '';
          foreach (json_decode($customOptions[$value], true) as $opt) {
            $selected = '';
            $selected_field_id = $customDependent->schema;
            if (isset($allFieldsData) && $allFieldsData[0]->$selected_field_id == $opt) {
              $selected = "selected";
            }
            $optHTML .= '<option value="' . $opt . '" ' . $selected . '>' . $opt . '<option>';
          }
          $options[$customDependent->schema] = $optHTML;
        }
      }
      return $options;
    }
  }
  public function stages($id)
  {
    $leadData = Lead::with('stage', 'subStage')->where('id', $id)->first();
    $stages = Stage::all();
    $subStages = SubStage::where('stage_id', $leadData->stage?->id)->get();
    return view('leads.stages', compact('leadData', 'stages', 'subStages'));
  }
  public function changeStages(Request $request, $id)
  {
    try {
      $updateLead = Lead::where('id', $id)->update(['stage_id' => $request->stage_id, 'sub_stage_id' => $request->sub_stage_id, 'comment' => $request->comment]);
      Log::channel('leadupdate')->info('updated_stage', ['updated_data' => $request->all(), 'lead_id' => $id]);
      return response()->json([
        'status' => 'success',
        'message' => 'Lead Updated successfully!',
      ]);
    } catch (\Exception $e) {
      $message = $e->getMessage();
      return response()->json([
        'status' => 'error',
        'message' => $message,
      ]);
    }
  }

  public function getSubStages($id)
  {
    $subStages = SubStage::where('stage_id', $id)->where('is_active', 1)->get();
    return $subStages;
  }

  public function reAssign($id)
  {
    $lead = Lead::where('id', $id)->first();
    $downlineIds = Helpers::getDownline(Auth::user()->id);
    $users = User::whereIn('id', $downlineIds)->get();
    return view('leads.re-assign.create', compact('lead', 'users'));
  }

  public function reAssignMultiple(Request $request)
  {
    $ids = $request->leadIds;
    $leadCount = count($request->leadIds);
    $downlineIds = Helpers::getDownline(Auth::user()->id);
    $users = User::whereIn('id', $downlineIds)->get();
    return view('leads.re-assign.create-multiple', compact('ids', 'leadCount', 'users'));
  }

  public function reAssignUpdate(Request $request, $id)
  {
    try {
      $updateLead = Lead::where('id', $id)->update(['user_id' => $request->user_id]);
      $opportunitiesUpdate = Opportunity::where('lead_id', $id)->update(['user_id' => $request->user_id]);
      Log::channel('leadupdate')->info('update_user', ['updated_data' => $request->all(), 'lead_id' => $id]);
      return response()->json([
        'status' => 'success',
        'message' => 'Lead re-assigned successfully!',
      ]);
    } catch (\Exception $e) {
      $message = $e->getMessage();
      return response()->json([
        'status' => 'error',
        'message' => $message,
      ]);
    }
  }

  public function reAssignUpdateMultiple(Request $request)
  {
    try {
      $ids = explode(",", $request->leadIds);
      $updateLead = Lead::whereIn('id', $ids)->update(['user_id' => $request->user_id]);
      $updateOpportunity = Opportunity::whereIn('lead_id', $ids)->update(['user_id' => $request->user_id]);
      return response()->json([
        'status' => 'success',
        'message' => 'Lead Updated successfully!',
      ]);
    } catch (\Exception $e) {
      $message = $e->getMessage();
      return response()->json([
        'status' => 'error',
        'message' => $message,
      ]);
    }
  }

  public function tasks()
  {
    return view('leads.tasks.index');
  }

  public function activities()
  {
    return view('leads.activities.index');
  }

  public function downloadEBrochure(Request $request, SMSOtpService $smsOtpService)
  {
    $validate = $request->validate([
      'fullName' => 'required|string',
      'phone' => 'required|string',
      'countryCode' => 'required|string',
      'campaign' => 'required|string',
    ]);

    try {
      $source = Source::where('name', 'Website')->first();
      if (!$source) {
        $source = Source::create(['name' => 'Website']);
      }
      $stage = Stage::where('is_initial', 1)->first();
      $subStage = SubStage::where('stage_id', $stage->id)->first();

      $owner = User::role('Super Admin')->first();
      $lead = Lead::updateOrCreate(['phone' => $validate['phone']], [
        'source_campaign' => $validate['campaign'],
        'first_name' => $validate['fullName'],
        'country_code' => $validate['countryCode'],
        'source_id' => $source->id,
        'stage_id' => $stage->id,
        'sub_stage_id' => $subStage->id,
        'user_id' => $owner->id
      ]);
      $otp = rand(100000, 999999);
      $smsOtpService->sendOtp($validate['phone'], $validate['countryCode'], $lead->id, $otp);
      LeadAssignmentRulesJob::dispatch($request->all(), $lead->id);
      return response()->json(['status' => true, 'leadId' => $lead->id, 'otp' => $otp, 'title' => 'Success', 'message' => 'OTP sent successfully!']);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage(), 'status' => false, 'message' => 'Something went wrong!']);
    }
  }

  public function callBackForm(Request $request)
  {
    $validate = $request->validate([
      'first_name' => 'required|string',
      'phone' => 'required|string',
      'email' => 'required|string',
      'program_id' => 'required|exists:programs,id',
    ]);

    try {
      $source = Source::where('name', 'Website')->first();
      if (!$source) {
        $source = Source::create(['name' => 'Website']);
      }

      $leadWithPhone = Lead::where('phone', $validate['phone'])->first();
      $leadWithEmail = Lead::where('email', $validate['email'])->first();

      if ($leadWithPhone && $leadWithEmail) {
        if ($leadWithPhone->id == $leadWithEmail->id) {
          $leadIds[] = $leadWithPhone->id;
        } elseif ($leadWithPhone->id != $leadWithEmail->id) {
          $leadIds[] = $leadWithPhone->id;
          $leadIds[] = $leadWithEmail->id;
        }
        // TODO: add Reborn Activity

      } elseif ($leadWithPhone) {
        $leadWithPhone->alternate_email = $validate['email'];
        $leadWithPhone->save();
        // TODO: add Reborn activity
      } elseif ($leadWithEmail) {
        $leadWithEmail->mobile = $validate['phone'];
        $leadWithEmail->save();
        // TODO: add Reborn activity
      } else {
        // Create Lead

        // Stage
        $stage = Stage::where('is_initial', 1)->first();
        $subStage = SubStage::where('stage_id', $stage->id)->first();

        $owner = User::role('Super Admin')->first();
        $lead = Lead::create([
          'first_name' => $validate['first_name'],
          'phone' => $validate['phone'],
          'email' => $validate['email'],
          'program_id' => $validate['program_id'],
          'source_id' => $source->id,
          'stage_id' => $stage->id,
          'sub_stage_id' => $subStage->id,
          'user_id' => $owner->id,
          'source_campaign' => "Call Back Form"
        ]);

        LeadAssignmentRulesJob::dispatch($request->all(), $lead->id);
      }

      return response()->json(['status' => 'success', 'message' => 'Enquiry submitted!', 'title' => 'Success']);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage(), 'status' => false, 'message' => 'Something went wrong!']);
    }
  }

  public function openProgramRegisterForm($slug)
  {
    return view('website.forms.enquiry-form-program', compact('slug'));
  }

  public function programRegisterFormStore(Request $request, SMSOtpService $smsOtpService, MailOtpService $mailOtpService)
  {
    $validate = $request->validate([
      'first_name' => 'required|string',
      'email' => 'required|string',
      'country_code' => 'required|string',
      'phone' => 'required|string',
      'country_id' => 'required|exists:countries,id',
      'state_id' => 'required|exists:states,id',
      'city_id' => 'required|exists:cities,id',
      'password' => 'required|string|confirmed',
      'password_confirmation' => 'required|string',
      'program_slug' => 'required|string',
      'gender' => 'required|string',
    ]);

    $leadWithEmail = Lead::where('email', $validate['email'])->first();
    $leadWithPhone = Lead::where('phone', $validate['phone'])->first();
    $otpRequired = true;
    if ($leadWithPhone && $leadWithEmail) {
      $leadId = $leadWithPhone->id;
      if ($leadWithPhone->id == $leadWithEmail->id) {
        $leadIds[] = $leadWithPhone->id;
      } elseif ($leadWithPhone->id != $leadWithEmail->id) {
        $leadIds[] = $leadWithPhone->id;
        $leadIds[] = $leadWithEmail->id;
      }
      // TODO: add Reborn Activity
    } elseif ($leadWithPhone) {
      $leadId = $leadWithPhone->id;

      $leadWithPhone->alternate_email = $validate['email'];
      $leadWithPhone->gender = $validate['gender'];
      $leadWithPhone->save();
      // TODO: add Reborn activity
    } elseif ($leadWithEmail) {
      $leadId = $leadWithEmail->id;

      $leadWithEmail->mobile = $validate['phone'];
      $leadWithEmail->gender = $validate['gender'];
      $leadWithEmail->save();
      // TODO: add Reborn activity
    } else {
      // Create Lead

      // Stage
      $stage = Stage::where('is_initial', 1)->first();
      $subStage = SubStage::where('stage_id', $stage->id)->first();

      // Source
      $source = Source::where('name', 'Website')->first();
      if (!$source) {
        $source = Source::create(['name' => 'Website']);
      }

      // Sub Source
      $subSource = SubSource::where('source_id', $source->id)->where('name', 'Register Form Course Page')->first();
      if (!$subSource) {
        $subSource = SubSource::create(['source_id' => $source->id, 'name' => 'Register Form Course Page']);
      }

      // Program
      $program = Program::where('slug', $validate['program_slug'])->first();
      if (!$program) {
        return response()->json(['error' => 'Program not found', 'status' => false, 'message' => 'Something went wrong!']);
      }

      $owner = User::role('Super Admin')->first();
      $lead = Lead::create([
        'first_name' => $validate['first_name'],
        'phone' => $validate['phone'],
        'email' => $validate['email'],
        'program_id' => $program->id,
        'source_id' => $source->id,
        'sub_source_id' => $subSource->id,
        'stage_id' => $stage->id,
        'sub_stage_id' => $subStage->id,
        'user_id' => $owner->id,
        'password' =>  Hash::make($validate['password']),
        'source_campaign' => "Explore Your Course",
        'country_id' => $validate['country_id'],
        'state_id' => $validate['state_id'],
        'city_id' => $validate['city_id'],
        'gender' => $validate['gender'],
      ]);

      $leadId = $lead->id;
      LeadAssignmentRulesJob::dispatch($request->all(), $lead->id);
    }

    $otpSentOnSMS = $otpSentOnMail = false;
    if ($otpRequired) {
      $otp = rand(100000, 999999);
      $otpSentOnSMS = $smsOtpService->sendOtp($validate['phone'], $validate['country_code'], $leadId, $otp);
      $otpSentOnMail = $mailOtpService->sendOtp($validate['email'], $leadId, $otp);
    }

    return response()->json(['status' => 'success', 'message' => 'Enquiry submitted successfully!', 'otp' => $otp, 'leadId' => $leadId, 'otpRequired' => $otpRequired, 'otpSentOnSMS' => $otpSentOnSMS, 'otpSentOnMail' => $otpSentOnMail, 'slug' => $validate['program_slug'], 'title' => 'Success']);
  }

  public function openEnrollNowForm(Request $request)
  {
    $validate = $request->validate([
      'program_id' => 'required|exists:programs,id',
      'campaign' => 'required|string',
      'vertical_id' => 'required|exists:verticals,id',
      'leadId' => 'required|exists:leads,id',
    ]);

    $specializationIds = Specialization::where('program_id', $validate['program_id'])->where('is_active', 1)->pluck('id')->toArray();
    $assignedToVerticals = ConstantFee::where('vertical_id', $validate['vertical_id'])->whereIn('specialization_id', $specializationIds)->distinct()->pluck('specialization_id')->toArray();
    $specializations = Specialization::with('programType', 'department')->whereIn('id', $assignedToVerticals)->get();
    return view('website.forms.enroll-now', ['specializations' => $specializations, 'program_id' => $validate['program_id'], 'vertical_id' => $validate['vertical_id'], 'campaign' => $validate['campaign'], 'leadId' => $validate['leadId']]);
  }

  public function enrollNowFormStore(Request $request)
  {
    $validate = $request->validate([
      'program_id' => 'required|exists:programs,id',
      'campaign' => 'required|string',
      'vertical_id' => 'required|exists:verticals,id',
      'leadId' => 'required|exists:leads,id',
      'specialization_id' => 'required|exists:specializations,id',
      'planning_to_start_in' => 'required|string',
      'for_whom' => 'string'
    ]);

    $lead = Lead::find($validate['leadId']);
    $validate['for_whom'] = empty($validate['for_whom']) ? "For My-Self" : $validate['for_whom'];
    $lead->planning_to_start_in = $validate['planning_to_start_in'];
    $lead->for_whom = $validate['for_whom'];
    $lead->save();
    // Create Opportunity

    // Stage
    $stage = Stage::where('is_initial', 1)->first();
    $subStage = SubStage::where('stage_id', $stage->id)->first();

    // Check Opportunity
    $opportunity = Opportunity::where('lead_id', $lead->id)->where('vertical_id', $validate['vertical_id'])->first();
    if ($opportunity) {
      if (empty($opportunity->admission_session_id)) {
        $opportunity->update(
          [
            'program_id' => $validate['program_id'],
            'specialization_id' => $validate['specialization_id'],
          ]
        );
      }
    } else {
      $opportunity = Opportunity::create(
        [
          'lead_id' => $lead->id,
          'stage_id' => $stage->id,
          'sub_stage_id' => $subStage->id,
          'vertical_id' => $validate['vertical_id'],
          'program_id' => $validate['program_id'],
          'specialization_id' => $validate['specialization_id'],
          'source_campaign' => $validate['campaign'],
          'user_id' => $lead->user_id
        ]
      );
    }


    return response()->json(['status' => 'success', 'message' => 'Submitted!']);
  }

  public function addFilterFileds()
  {
    $verticals = Vertical::all();
    $allFields  = CustomField::whereNot('use_for', 'opportunity')->where('is_core_field', 1)->get();
    $fields = '';
    if (session()->has('filterjson')) {
      $filterArray = session()->get('filterjson');
      foreach ($filterArray['filter_on'] as $key => $rule) {
        $values['schema'] = $rule;
        $values['operator'] = $filterArray['filter_type'][$key];
        $field_value = AssignmentRulesController::fieldValue($rule, $filterArray['filter_value'][$rule]);
        $fields .= AssignmentRulesController::addFilter($values, $field_value, $key);
      }
    }
    return view('leads.filter.filter', compact(['allFields', 'verticals', 'fields']));
  }
  // News Letter Subscribers
  public function newsletterSubscribersStore(Request $request)
  {
    $validate = $request->validate([
      'email' => 'required|email|unique:newsletter_subscribers,email',
    ]);

    try {
      $subscriber = new NewsLetterSubscriber();
      $subscriber->email = $validate['email'];
      $subscriber->save();

      return response()->json(['status' => 'success', 'message' => 'Subscribed successfully!', 'title' => 'Success!']);
    } catch (\Exception $e) {
      if (strpos($e->getMessage(), 'already') !== false) {
        return response()->json(['status' => 'success', 'message' => 'Subscribed successfully!', 'title' => 'Success!']);
      }
    }
  }

  public function resetFilter()
  {
    session()->has('filterjson') ? session()->remove("filterjson") : "";
  }


  // Import Leads
  public function showImport()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('import leads')) {
      return view('leads.import.create');
    }
  }

  public function downloadSample()
  {
    $filePath = storage_path('app/lead-import-sample.csv');
    if (!file_exists($filePath)) {
      return response()->json(['error' => 'Sample file not found.'], 404);
    }
    return response()->download($filePath, 'Lead Import Sample.csv');
  }

  public function importStore(Request $request)
  {
    $request->validate([
      'file' => 'required|mimes:csv,txt|max:2048',
    ]);

    $import = new LeadsImport();
    Excel::import($import, $request->file('file'));

    // Store the status for the session
    session(['lead_import_status' => $import->statuses]);

    return response()->json([
      'status' => 'success',
      'title' => 'Success',
      'message' => 'CSV processed successfully!',
    ]);
  }

  public function downloadImportStatus()
  {
    if (!session()->has('lead_import_status')) {
      return response()->json(['error' => 'No import status available.'], 400);
    }

    $statuses = session('lead_import_status');

    // Generate and return the file download response
    return Excel::download(new LeadsImportStatusExport($statuses), 'Lead Import Status.xlsx');
  }

  public function getAllLeads()
  {
    $data = Lead::with(['program', 'specialization'])->orderBy('id', 'desc')->get()
      ->map(function ($lead) {
          return [
              'name' => $lead->first_name.' '.$lead->last_name,
              'email' => $lead->email,
              'phone' => $lead->country_code . '-' . $lead->phone,
              'date_of_birth' => $lead->date_of_birth,
              'program' => optional($lead->program)->name,
              'specialization' => optional($lead->specialization)->name
          ];
      });
      return $data;
  }

}
