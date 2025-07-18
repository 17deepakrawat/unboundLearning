<?php

namespace App\Http\Controllers\Academics;

use App\Exports\ApplicationExport;
use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Settings\Leads\AssignmentRulesController;
use App\Http\Controllers\Settings\Leads\CustomFieldController;
use App\Models\Academics\Application;
use App\Models\Academics\ApplicationFields;
use App\Models\Academics\ApplicationForm;
use App\Models\Academics\ApplicationSteps;
use App\Models\Academics\Program;
use App\Models\Academics\ProgramType;
use App\Models\Academics\Specialization;
use App\Models\Academics\StudentDocument;
use App\Models\Academics\Vertical;
use App\Models\Leads\Opportunity;
use App\Models\Settings\Admissions\AdmissionSession;
use App\Models\Settings\Admissions\AdmissionSessionAdmissionType;
use App\Models\Settings\Admissions\StudentStatus;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubStage;
use App\Models\Settings\Leads\CustomField;
use App\Models\SpecializationVertical;
use App\Models\User;
use App\Models\Leads\OpportunityCustomField;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view applications')) {
      if ($request->ajax()) {
        $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);
        $data = Opportunity::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
          return $query->whereIn('user_id', $downline)->orWhereIn('application_owner_id', $downline);
        })->with(['lead', 'stage', 'subStage', 'vertical', 'program', 'specialization', 'user', 'admissionSession', 'admissionType', 'applicationOwner', 'studentStatus', 'opportunityLedger'])->whereNotNull('conversion_date')->orderBy('id', 'desc');
        if (($request->ajax() && isset($request->filter_on) && !empty($request->filter_on)) || session()->has('applicationfilterjson')) {
          if (!empty($request->filter_on) && count($request->filter_on) > 0) {
            session()->put('applicationfilterjson', ['filter_on' => $request->filter_on, 'filter_type' => $request->filter_type, 'filter_value' => $request->filter_value]);
          }
          $filterJson = session('applicationfilterjson');
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
          ->addColumn('document', function ($data) {
            $document = StudentDocument::where('opportunities_id', $data->id)->first();
            return $document;
          })
          ->make(true);
      }
      return view('academics.application.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }
  public function create($opportunityId)
  {
    $opportunity = Opportunity::where('id', $opportunityId)->with('lead', 'program', 'specialization')->first()->toArray();
    $applicationSteps = ApplicationSteps::where('vertical_id', $opportunity['vertical_id'])->orderBy('position')->with('fields')->get();
    $vertical = Vertical::find($opportunity['vertical_id']);
    // Get only dropdown fields associated with vertical
    $applicationFields = ApplicationFields::where('vertical_id', $opportunity['vertical_id'])->with('customFields')->get();
    // exclude core fields
    $applicationFields = $applicationFields->filter(function ($field) {
      return $field->customFields->is_core_field == 0;
    });
    // get only dropdown fields
    $dropdownFields = $applicationFields->filter(function ($field) {
      return $field->customFields->type == 'Dropdown' || $field->customFields->type == 'Dependent Dropdown';
    });

    $dropdownFields = $dropdownFields->map(function ($field) {
      $field->customFields->pre_selected_options = json_decode($field->customFields->pre_selected_options, true);
      return $field->customFields;
    });
  
    return view("academics.application.create", compact('applicationSteps', 'opportunity', 'vertical', 'applicationFields', 'dropdownFields'));
  }

  public function store(Request $request)
  {
    $leadFieldsData = array();
    $opportunityFieldsData = array();
    $customFieldsData = array();
    $verticalId = $request->vertical_id;
    $applicationSteps = ApplicationSteps::where('vertical_id', $verticalId)->orderBy('position')->with('fields')->get();
    foreach ($applicationSteps as $step) {
      foreach ($step->fields as $field) {

        if ($field->customFields->use_for == 'opportunity' && $field->customFields->is_core_field == 1) {
          $opportunityFieldsData[$field->customFields->schema] = $request[$field->customFields->schema];
        } elseif ($field->customFields->use_for == 'lead' && $field->customFields->is_core_field == 1) {
          if ($field->customFields->type == 'File') {
            if ($request->hasFile($field->customFields->schema)) {
              $path = 'students';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }
              $path = $path . '/files';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }
              $path = $path . '/' . $request->id;
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }
              $images = array();
              if (is_array($request->file($field->customFields->schema))) {
                foreach ($request->file($field->customFields->schema) as $key => $image) {
                  $newFileName =  $field->customFields->schema . '_' . ($key + 1) . '.' . $image->extension();
                  $image->move(public_path($path), $newFileName);
                  $images[$key] = $path . '/' . $newFileName;
                }
              } else {
                $image = $request->file($field->customFields->schema);
                $newFileName = $field->customFields->schema . '.' . $image->extension();
                $image->move(public_path($path), $newFileName);
                $images[] = $path . '/' . $newFileName;
              }
              $leadFieldsData[$field->customFields->schema] = json_encode($images);
            }
          } elseif ($field->customFields->type == 'Date') {
            $leadFieldsData[$field->customFields->schema] = Carbon::createFromFormat('d-m-Y', $request[$field->customFields->schema])->format('Y-m-d');
          } elseif ($field->customFields->type == 'Time') {
            $leadFieldsData[$field->customFields->schema] = Carbon::createFromFormat('h:i A', $request[$field->customFields->schema])->format('H:i:00');
          } elseif ($field->customFields->type == 'Date Time') {
            $leadFieldsData[$field->customFields->schema] = Carbon::createFromFormat('d-m-Y H:i A', $request[$field->customFields->schema])->format('Y-m-d H:i:00');
          } else {
            $leadFieldsData[$field->customFields->schema] = $request[$field->customFields->schema];
          }
        } elseif ($field->customFields->use_for == 'opportunity' && $field->customFields->is_core_field == 0) {
          if ($field->customFields->type == 'File') {
            if ($request->hasFile($field->customFields->schema)) {
              $path = 'students';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }
              $path = $path . '/files';
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }
              $path = $path . '/' . $request->id;
              if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777);
              }
              $images = array();
              if (is_array($request->file($field->customFields->schema))) {
                foreach ($request->file($field->customFields->schema) as $key => $image) {
                  $newFileName =  $field->customFields->schema . '_' . ($key + 1) . '.' . $image->extension();
                  $image->move(public_path($path), $newFileName);
                  $images[$key] = $path . '/' . $newFileName;
                }
              } else {
                $image = $request->file($field->customFields->schema);
                $newFileName = $field->customFields->schema . '.' . $image->extension();
                $image->move(public_path($path), $newFileName);
                $images[] = $path . '/' . $newFileName;
              }
              $customFieldsData[$field->customFields->schema] = json_encode($images);
            }
          } elseif ($field->customFields->type == 'Date') {
            $customFieldsData[$field->customFields->schema] = Carbon::createFromFormat('d-m-Y', $request[$field->customFields->schema])->format('Y-m-d');
          } elseif ($field->customFields->type == 'Time') {
            $customFieldsData[$field->customFields->schema] = Carbon::createFromFormat('h:i A', $request[$field->customFields->schema])->format('H:i:00');
          } elseif ($field->customFields->type == 'Date Time') {
            $customFieldsData[$field->customFields->schema] = Carbon::createFromFormat('d-m-Y H:i A', $request[$field->customFields->schema])->format('Y-m-d H:i:00');
          } else {
            $customFieldsData[$field->customFields->schema] = is_array($request[$field->customFields->schema]) ? json_encode($request[$field->customFields->schema], true) : $request[$field->customFields->schema];
          }
        }
      }
    }

    // Admission Done Stage
    $stage = Stage::where('is_final', true)->first();
    if (!$stage) {
      $stage = Stage::create(['name' => 'Admission Done']);
      $stage->is_final = true;
      $stage->save();
    }

    $subStage = SubStage::where('stage_id', $stage->id)->where('name', 'LIKE', 'Application Form Submitted')->first();
    if (!$subStage) {
      $subStage = SubStage::create(['name' => 'Form Submitted', 'stage_id' => $stage->id]);
    }

    // Specialization
    $specialization = Specialization::find($request->specialization_id);

    // Scheme
    $currentDate = date("Y-m-d");
    $schemeId = 0;
    $admissionSession = AdmissionSession::where('id', $request->admission_session_id)->with('admissionSessionAdmissionTypes')->first();
    foreach ($admissionSession->admissionSessionAdmissionTypes as $admissionSessionAdmissionType) {
      if ($admissionSessionAdmissionType->admission_type_id == $request->admission_type_id) {
        foreach ($admissionSessionAdmissionType->schemes as $scheme) {
          if ($scheme->pivot->start_date <= $currentDate) {
            $schemeId = $scheme->id;
          }
        }
      }
    }

    // Student Status
    $studentStatus = StudentStatus::where('name', 'New')->first();

    // Modifications
    $customFieldsData['opportunity_id'] = $request->id;
    $opportunityFieldsData['stage_id'] = $stage->id;
    $opportunityFieldsData['sub_stage_id'] = $subStage->id;
    $opportunityFieldsData['program_id'] = $specialization->program_id;
    $opportunityFieldsData['scheme_id'] = $schemeId;
    $opportunityFieldsData['student_status_id'] = $studentStatus->id;
    $opportunityFieldsData['conversion_date'] = Carbon::now()->setTimezone(env('APP_TIMEZONE_NAME', 'UTC'))->format('Y-m-d H:i:s');;

    try {
      $opportunity = Opportunity::where('id', $request->id)->update($opportunityFieldsData);
      // $lead = Opportunity::where('id', $request->id)->update($leadFieldsData);
      $opportunityCustomFields = OpportunityCustomField::where('opportunity_id', $request->id)->first();
      if (!$opportunityCustomFields) {
        $customFieldsData['opportunity_id'] = $request->id;
        $customFields = OpportunityCustomField::insert($customFieldsData);
      } else {
        $customFields = OpportunityCustomField::where('id', $opportunityCustomFields->id)->update($customFieldsData);
      }

      return response()->json([
        'status' => 'success',
        'message' => 'Application submitted successfully!',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }
  public function getAdmissionTypeOnSession($sessionId)
  {
    try {
      $admissionTypes = AdmissionSessionAdmissionType::where('admission_session_id', $sessionId)->with('admissionType')->get();
      return response()->json([
        'status' => 'success',
        'data' => $admissionTypes
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }

  public function getProramsOnProgramType($program_type_id)
  {
    $option = '<option value=""><option>';
    $programs = Program::with('programTypes')->get();
    foreach ($programs->toArray() as $key => $program) {
      foreach ($program['program_types'] as $typeid) {
        if ($program_type_id == $typeid['id']) {
          $option .= '<option value="' . $program['id'] . '">' . $program['name'] . '<option>';
        }
      }
    }
    return $option;
  }
  public function getSpecializationOnProgrm($sub_cource_id)
  {
    $option = '<option value=""></option>';
    $specialization = Specialization::where('program_id', $sub_cource_id)->with('mode')->get();
    foreach ($specialization->toArray() as $key => $value) {
      $option .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
    }
    return $option;
  }
  public function getAdmissionDuration(Request $request)
  {
    $specializationId = $request->specializationId;
    $admissionTypeId = $request->admissionTypeId;

    $admissionDurations = array();
    $specializationVertical = SpecializationVertical::where('specialization_id', $specializationId)->where('admission_type_id', $admissionTypeId)->first();
    if ($specializationVertical) {
      $admissionDurations = json_decode($specializationVertical->admission_duration, true);
    }

    return response()->json([
      'status' => 'success',
      'data' => $admissionDurations,
    ]);
  }
  public function setVerticalForApplication()
  {
    $verticals = Vertical::all();
    return view("academics.application.setvertical", ['verticals' => $verticals]);
  }

  public function update(Request $request, $id)
  {

    try {
      $application = Application::findOrFail($id);
      $inserData = [];
      foreach ($request->all() as $key => $customField) {
        if (strpos($key, '__udf__') === 0) {
          if (is_array($customField)) {
            $customField = json_encode($customField);
          }
          if ($request->hasfile($key)) {
            $path = 'assets/customfile';
            $ext = $request->$key->extension();
            $filename = time() . '.' . $ext;
            $request->$key->move(public_path($path), $filename);
            $customField = $path . '/' . $filename;
          }
          $column = str_replace('__udf__', '', $key);
          $inserData[$column] = $customField;
        }
      }
      if (!empty($inserData)) {
        $inserData['application_id'] = $id;
        $insert = ApplicationForm::updateOrInsert(['application_id' => $id], $inserData);
        $application->update(['step_status' => $request->step_status]);
      } else {
        $update = $application->update($request->all());
      }
      return response()->json([
        'status' => 'success',
        'message' => 'Apllication form submitted'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }
  public function edit($id)
  {
    $applicationData = Opportunity::where('id', $id)->get();
    if (!empty($applicationData->toArray())) {
      $opportunity = Opportunity::where('id', $id)->with('lead', 'program', 'specialization')->first()->toArray();
      $applicationSteps = ApplicationSteps::where('vertical_id', $opportunity['vertical_id'])->orderBy('position')->with('fields')->get();
      $opportunityCustomFields = OpportunityCustomField::where('opportunity_id', $id)->first();
      $vertical = Vertical::find($opportunity['vertical_id']);
      // Get only dropdown fields associated with vertical
      $applicationFields = ApplicationFields::where('vertical_id', $opportunity['vertical_id'])->with('customFields')->get();
      // exclude core fields
      $applicationFields = $applicationFields->filter(function ($field) {
        return $field->customFields->is_core_field == 0;
      });
      
      // get only dropdown fields
      $dropdownFields = $applicationFields->filter(function ($field) {
        return $field->customFields->type == 'Dropdown' || $field->customFields->type == 'Dependent Dropdown';
      });
      
      $dropdownFields = $dropdownFields->map(function ($field) {
        $field->customFields->pre_selected_options = json_decode($field->customFields->pre_selected_options, true);
        return $field->customFields;
      });
      return view("academics.application.edit", compact('applicationSteps', 'opportunity', 'vertical', 'applicationFields', 'dropdownFields','opportunityCustomFields'));
    } else {
      return response()->json([
        'status' => 'error',
        'message' => 'Please convert to application first'
      ]);
    }
  }

  public function getStudentsDocuments($opportunityId)
  {
    $opportunity = Opportunity::where('id', $opportunityId)->first();

    $applicationFields = ApplicationFields::where('vertical_id', $opportunity->vertical_id)->pluck('field_id')->toArray();

    $allCustomFields = CustomField::whereIn('id', $applicationFields)->where('type', 'File')->whereNot('schema', 'avatar')->pluck('schema');

    $submittedDocuments = [];
    if ($allCustomFields->count() > 0) {

      $studentsAllDocumentData = OpportunityCustomField::where('opportunity_id', $opportunityId)->get($allCustomFields->toArray());
      if (!empty($studentsAllDocumentData) && count($studentsAllDocumentData) > 0) {
        foreach ($studentsAllDocumentData[0]->toArray() as $columnName => $documentsArr) {
          $allDocuments = !empty($documentsArr) ? json_decode($documentsArr, true) : [];
          foreach ($allDocuments as $key => $docs) {
            $submittedDocuments[ucwords(str_replace('_', ' ', $columnName))][$key]['path'] = asset($docs);
            $submittedDocuments[ucwords(str_replace('_', ' ', $columnName))][$key]['extension'] = pathinfo(asset($docs))['extension'];
          }
        }
      }
    }

    $hasFileTypeFields = $allCustomFields->count() > 0 ? true : false;
    return view('academics.application.review-document', compact('submittedDocuments', 'opportunityId', 'hasFileTypeFields'));
  }

  public function addFilterFileds()
  {
    $verticals = Vertical::all();
    $allFields  = CustomField::whereNot('use_for', 'lead')->where('is_core_field', 1)->get();
    $fields = '';
    if (session()->has('applicationfilterjson')) {
      $filterArray = session()->get('applicationfilterjson');
      foreach ($filterArray['filter_on'] as $key => $rule) {
        $values['schema'] = $rule;
        $values['operator'] = $filterArray['filter_type'][$key];
        $field_value = AssignmentRulesController::fieldValue($rule, $filterArray['filter_value'][$rule]);
        $fields .= AssignmentRulesController::addFilterForApplication($values, $field_value, $key);
      }
    }
    return view('academics.application.filter.filter', compact(['allFields', 'verticals', 'fields']));
  }

  public function resetFilter()
  {
    session()->has('applicationfilterjson') ? session()->remove("applicationfilterjson") : "";
  }

  public function export()
  {
    return Excel::download(new ApplicationExport, 'application.xlsx');
  }
}
