<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Academics\SpecializationRequest;
use App\Models\Academics\ConstantFee;
use App\Models\Academics\Department;
use App\Models\Academics\ProgramProgramTypeDepartmentVertical;
use App\Models\Academics\Specialization;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\AdmissionSession;
use App\Models\Settings\Admissions\EligibilityCriterion;
use App\Models\Settings\Admissions\Mode;
use App\Models\SpecializationVertical;
use App\Models\User\UserSharing;
use App\Models\User\UserSharingFee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SpecializationController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view specializations')) {
      if ($request->ajax()) {
        $data = Specialization::with(['department', 'program', 'programType', 'mode', 'constantFees'])->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('academics.specializations.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create specializations')) {
      $departments = Department::all();
      $eligibilityCriteria = EligibilityCriterion::get(['id', 'name']);
      $modes = Mode::all();
      return view('academics.specializations.create', ['departments' => $departments, 'eligibilityCriteria' => $eligibilityCriteria, 'modes' => $modes]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(SpecializationRequest $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create specializations')) {
      try {
        $specialization = Specialization::create($request->all());

        $criteria = array();
        if ($request->required_eligibility_criterion_ids) {
          foreach ($request->required_eligibility_criterion_ids as $id) {
            $criteria[$id] = ['is_required' => true];
          }
        }


        if ($request->optional_eligibility_criterion_ids) {
          foreach ($request->optional_eligibility_criterion_ids as $id) {
            $criteria[$id] = ['is_required' => false];
          }
        }

        $specialization->eligibilityCriteria()->sync($criteria);
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' created successfully!',
        ]);
      } catch (\Exception $e) {
        $message = strpos($e->getMessage(), 'Duplicate') !== false
          ? 'A specialization with the same name in department and program already exists.'
          : $e->getMessage();
        return response()->json([
          'status' => 'error',
          'message' => $message,
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function edit($specializationId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      $specialization = Specialization::with(['eligibilityCriteria'])->where('id', $specializationId)->first();
      $departments = Department::all();
      $eligibilityCriteria = EligibilityCriterion::get(['id', 'name']);
      $modes = Mode::all();
      return view('academics.specializations.edit', ['specialization' => $specialization, 'departments' => $departments, 'eligibilityCriteria' => $eligibilityCriteria, 'modes' => $modes]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(SpecializationRequest $request, $specializationId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      try {
        $specialization = Specialization::find($specializationId);
        $specialization->update($request->all());

        $criteria = array();
        foreach ($request->required_eligibility_criterion_ids as $id) {
          $criteria[$id] = ['is_required' => true];
        }

        if ($request->optional_eligibility_criterion_ids) {
          foreach ($request->optional_eligibility_criterion_ids as $id) {
            $criteria[$id] = ['is_required' => false];
          }
        }

        $specialization->eligibilityCriteria()->sync($criteria);
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        $message = strpos($e->getMessage(), 'Duplicate') !== false
          ? 'A specialization with the same name in department and program already exists.'
          : 'An error occurred while creating the specialization.';
        return response()->json([
          'status' => 'error',
          'message' => $message,
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function status($specializationId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      try {
        $specialization = Specialization::findOrFail($specializationId);
        if ($specialization) {
          $specialization->is_active = $specialization->is_active == 1 ? 0 : 1;
          $specialization->save();
          return response()->json([
            'status' => 'success',
            'message' => $specialization->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Program not found',
          ]);
        }
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    }
  }

  public function content($specializationId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      $specialization = Specialization::with('program', 'programType', 'department', 'mode', 'constantFees')->where('id', $specializationId)->first();
      $icons = File::get(public_path('assets/json/icon-list.json'));
      $icons = json_decode($icons, true);
      return view('academics.specializations.content', compact(['specialization', 'icons']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function skilContent($specializationId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      $specialization = Specialization::with('program', 'programType', 'department', 'mode', 'constantFees')->where('id', $specializationId)->first();
      $icons = File::get(public_path('assets/json/icon-list.json'));
      $icons = json_decode($icons, true);
      return view('academics.specializations.skill.content', compact(['specialization', 'icons']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function contentStore(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      $request->validate([
        'id' => ['required', 'exists:specializations,id'],
        'content.meta' => ['required', 'array'],
        'content.meta.title' => ['required', 'string'],
        'content.section_1' => ['required', 'string'],
        'content.section_2' => ['string'],
        'images.*' => ['image', 'mimes:webp,jpeg,png', 'max:300'],
        'icons' => ['array']
      ]);

      try {
        $specialization = Specialization::findOrFail($request->id);

        $content = $request->content;
        if(isset($content['tegSection']['tagimage']) && count($content['tegSection']['tagimage'])>0)
        {
          $path = 'assets/tag/images';
          foreach ($content['tegSection']['tagimage'] as $key => $image) {
            $newFileName = rand().time() . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images = $path . '/' . $newFileName;
            $content['tegSection']['tagimage'][$key] = $images;
          }
          
        }
        if(isset($content['skillSection']['skillimage']) && count($content['skillSection']['skillimage'])>0)
        {
          $path = 'assets/skill/images';
          foreach ($content['skillSection']['skillimage'] as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images = $path . '/' . $newFileName;
            $content['skillSection']['skillimage'][$key] = $images;
          }
          
        }
        if(isset($content['toolcover']) && count($content['toolcover'])>0)
        {
          $path = 'assets/skill/toolcover/images';
          foreach ($content['toolcover'] as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images = $path . '/' . $newFileName;
            $content['toolcover'][$key] = $images;
          }
          
        }
        if(isset($content['jobroleSection']['jobroleimage']) && count($content['jobroleSection']['jobroleimage'])>0)
        {
          $path = 'assets/jobrole/images';
          foreach ($content['jobroleSection']['jobroleimage'] as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images = $path . '/' . $newFileName;
            $content['jobroleSection']['jobroleimage'][$key] = $images;
          }
          
        }
        if(isset($content['studentSection']['studentimage']) && count($content['studentSection']['studentimage'])>0)
        {
          $path = 'assets/student/images';
          foreach ($content['studentSection']['studentimage'] as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images = $path . '/' . $newFileName;
            $content['studentSection']['studentimage'][$key] = $images;
          }
          
        }
        if(isset($content['learnSection']['learnimage']) && count($content['learnSection']['learnimage'])>0)
        {
          $path = 'assets/learn/images';
          foreach ($content['learnSection']['learnimage'] as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images = $path . '/' . $newFileName;
            $content['learnSection']['learnimage'][$key] = $images;
          }
          
        }
        $icons = $request->icons;
        $images = !empty($specialization->images) ? json_decode($specialization->images, true) : array();
        if ($request->hasFile('images')) {
          $path = 'assets/img/programs';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = 'assets/img/programs/images';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = $path . '/' . $request->id;
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }

          foreach ($request->file('images') as $key => $image) {
            $newFileName = $key . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images[$key] = $path . '/' . $newFileName;
          }
        }
        $images['icons'] = $icons;

        $specialization->content = json_encode($content);
        $specialization->images = json_encode($images);
        $specialization->save();
        return response()->json([
          'status' => 'success',
          'message' => $specialization->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage(),
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function assignVertical($specializationId)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit specializations')) {
      $specialization = Specialization::with('program', 'programType', 'department', 'mode', 'constantFees')->where('id', $specializationId)->first();

      $allotedFees = array();
      foreach ($specialization->constantFees as $fee) {
        if ($fee->admission_type_id) {
          $allotedFees[$fee->vertical_id][$fee->scheme_id][$fee->fee_type][$fee->fee_structure_id]['admission_type'][$fee->duration]['fee'] = $fee->fee;
          $allotedFees[$fee->vertical_id][$fee->scheme_id][$fee->fee_type][$fee->fee_structure_id]['admission_type'][$fee->duration]['id'] = $fee->admission_type_id;
        } else {
          $allotedFees[$fee->vertical_id][$fee->scheme_id][$fee->fee_type][$fee->fee_structure_id][$fee->duration] = $fee->fee;
        }
      }

      $programId = $specialization->program->id;
      $programTypeId = $specialization->programType->id;
      $departmentId = $specialization->department->id;

      $programProgramTypeDepartmentVerticals = ProgramProgramTypeDepartmentVertical::where('program_id', $programId)->with(['programTypeDepartmentVerticals' => function ($programQuery) use ($programId, $departmentId, $programTypeId) {
        $programQuery->where('program_type_id', $programTypeId)->with(['departmentVertical' => function ($departmentQuery) use ($departmentId) {
          $departmentQuery->where('department_id', $departmentId)->with(['vertical' => function ($verticalQuery) {
            $verticalQuery->whereNotNull('id')->with('schemes', 'admissionTypes');
          }]);
        }]);
      }])->get();
      return view('academics.specializations.assign-vertical', ['specialization' => $specialization, 'allotedFees' => $allotedFees, 'programProgramTypeDepartmentVerticals' => $programProgramTypeDepartmentVerticals]);
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function assignVerticalStore(Request $request)
  {
    $id = $request->specializationId;
    $fee = $request->fee;

    foreach ($fee as $verticalId => $scheme) {
      foreach ($scheme as $schemeId => $feeType) {
        foreach ($feeType as $feeTypeName => $feeStructures) {
          foreach ($feeStructures as $feeStructureId => $durations) {
            foreach ($durations as $duration => $amount) {
              if (!is_array($amount)) {
                if ($amount == '') {
                  return response()->json([
                    'status' => 'error',
                    'message' => 'Fee cannot be empty!',
                  ]);
                }
              } else {
                if ($amount[0]['fee'] == '') {
                  return response()->json([
                    'status' => 'error',
                    'message' => 'Fee cannot be empty!',
                  ]);
                }

                if ($amount[0]['id'] == '') {
                  return response()->json([
                    'status' => 'error',
                    'message' => 'Please choose Admission Type!',
                  ]);
                }
              }
            }
          }
        }
      }
    }

    foreach ($fee as $verticalId => $scheme) {
      foreach ($scheme as $schemeId => $feeType) {
        foreach ($feeType as $feeTypeName => $feeStructures) {
          foreach ($feeStructures as $feeStructureId => $durations) {
            foreach ($durations as $duration => $amount) {
              if (!is_array($amount)) {
                $checkExists = ConstantFee::where('vertical_id', $verticalId)->where('scheme_id', $schemeId)->where('fee_structure_id', $feeStructureId)->where('specialization_id', $id)->where('fee_type', $feeTypeName)->where('duration', $duration)->first();
                if ($checkExists) {
                  try {
                    $checkExists->update(['fee' => $amount]);
                  } catch (\Exception $e) {
                    return response()->json([
                      'status' => 'error',
                      'message' => $e->getMessage(),
                    ]);
                  }
                } else {
                  try {
                    ConstantFee::create([
                      'vertical_id' => $verticalId,
                      'scheme_id' => $schemeId,
                      'fee_structure_id' => $feeStructureId,
                      'specialization_id' => $id,
                      'fee_type' => $feeTypeName,
                      'duration' => $duration,
                      'fee' => $amount,
                    ]);
                  } catch (\Exception $e) {
                    return response()->json([
                      'status' => 'error',
                      'message' => $e->getMessage(),
                    ]);
                  }
                }
              } else {
                $checkExists = ConstantFee::where('vertical_id', $verticalId)->where('scheme_id', $schemeId)->where('fee_structure_id', $feeStructureId)->where('specialization_id', $id)->where('fee_type', $feeTypeName)->where('duration', $duration)->first();
                if ($checkExists) {
                  try {
                    $checkExists->update(['fee' => $amount[0]['fee'], 'admission_type_id' => $amount[0]['id']]);
                  } catch (\Exception $e) {
                    return response()->json([
                      'status' => 'error',
                      'message' => $e->getMessage(),
                    ]);
                  }
                } else {
                  try {
                    ConstantFee::create([
                      'vertical_id' => $verticalId,
                      'scheme_id' => $schemeId,
                      'fee_structure_id' => $feeStructureId,
                      'specialization_id' => $id,
                      'fee_type' => $feeTypeName,
                      'duration' => 0,
                      'fee' => $amount[0]['fee'],
                      'admission_type_id' => $amount[0]['id'],
                    ]);
                  } catch (\Exception $e) {
                    return response()->json([
                      'status' => 'error',
                      'message' => $e->getMessage(),
                    ]);
                  }
                }
              }
            }
          }
        }
      }
    }

    return response()->json([
      'status' => 'success',
      'message' => 'Fee structure updated successfully!',
    ]);
  }

  public function configureVertical(Request $request)
  {
    $verticalId = $request->verticalId;
    $specializationId = $request->specializationId;
    $vertical = Vertical::with('admissionTypes', 'eligibilityCriteria')->find($verticalId);
    $specialization = Specialization::find($specializationId);
    $specializationVerticals = SpecializationVertical::where('vertical_id', $verticalId)->where('specialization_id', $specialization->id)->get();
    $specializationVerticalData = array();
    foreach ($specializationVerticals as $specializationVertical) {
      $specializationVerticalData[$specializationVertical->admission_type_id]['admission_duration'] = json_decode($specializationVertical->admission_duration, 'true');
      $specializationVerticalData[$specializationVertical->admission_type_id]['is_active'] = $specializationVertical->is_active;
      $specializationVerticalData[$specializationVertical->admission_type_id]['required_eligibility_criteria'] = json_decode($specializationVertical->required_eligibility_criteria_id, 'true');
      $specializationVerticalData[$specializationVertical->admission_type_id]['optional_eligibility_criteria'] = json_decode($specializationVertical->optional_eligibility_criteria_id, 'true');
    }

    return view('academics.specializations.configure-vertical', ['vertical' => $vertical, 'specialization' => $specialization, 'specializationVerticalData' => $specializationVerticalData]);
  }

  // DropDowns
  public function specializationsByProgram($programId)
  {
    try {
      $specializations = Specialization::where('program_id', $programId)->with('programType')->where('is_active', true)->get();
      return response()->json([
        'status' => 'success',
        'specializations' => $specializations
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ]);
    }
  }

  public function specializationsByVerticalAndProgram($verticalId, $programId)
  {
    try {
      $specializationIds = Specialization::where('program_id', $programId)->where('is_active', 1)->pluck('id')->toArray();
      $assignedToVerticals = ConstantFee::where('vertical_id', $verticalId)->whereIn('specialization_id', $specializationIds)->distinct()->pluck('specialization_id')->toArray();
      $specializations = Specialization::with('programType', 'department')->whereIn('id', $assignedToVerticals)->get();
      if ($specializations) {
        return response()->json([
          'status' => 'success',
          'specializations' => $specializations
        ]);
      }

      $specializations = Specialization::with('programType', 'department')->whereIn('id', $specializationIds)->get();
      return response()->json([
        'status' => 'success',
        'specializations' => $specializations
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }

  // Configure Store
  public function configureStore(Request $request)
  {
    try {
      if (!$request->has('admission_type_ids')) {
        return response()->json([
          'status' => 'error',
          'message' => 'Please select admission type!',
        ]);
      }

      if (!$request->has('admission_durations')) {
        return response()->json([
          'status' => 'error',
          'message' => 'Please select admission duration!',
        ]);
      }

      if (!$request->has('required_eligibility_criteria_ids')) {
        return response()->json([
          'status' => 'error',
          'message' => 'Please select required eligibility criteria!',
        ]);
      }

      if (!$request->has('optional_eligibility_criteria_ids')) {
        return response()->json([
          'status' => 'error',
          'message' => 'Please select optional eligibility criteria!',
        ]);
      }

      foreach ($request->admission_type_ids as $admission_type_id) {
        $admissionDurations = array_key_exists($admission_type_id, $request->admission_durations) ? $request->admission_durations[$admission_type_id] : array();
        $requiredEligibilityCriteriaIds = array_key_exists($admission_type_id, $request->required_eligibility_criteria_ids) ? $request->required_eligibility_criteria_ids[$admission_type_id] : array();
        $optionalEligibilityCriteriaIds = array_key_exists($admission_type_id, $request->optional_eligibility_criteria_ids) ? $request->optional_eligibility_criteria_ids[$admission_type_id] : array();

        if (empty($admissionDurations)) {
          return response()->json([
            'status' => 'error',
            'message' => 'Please select admission duration!',
          ]);
        }

        if (empty($requiredEligibilityCriteriaIds)) {
          return response()->json([
            'status' => 'error',
            'message' => 'Please select required eligibility criteria!',
          ]);
        }

        if (empty($optionalEligibilityCriteriaIds)) {
          return response()->json([
            'status' => 'error',
            'message' => 'Please select optional eligibility criteria!',
          ]);
        }
      }

      foreach ($request->admission_type_ids as $admission_type_id) {
        $admissionDurations = array_key_exists($admission_type_id, $request->admission_durations) ? $request->admission_durations[$admission_type_id] : array();
        $requiredEligibilityCriteriaIds = array_key_exists($admission_type_id, $request->required_eligibility_criteria_ids) ? $request->required_eligibility_criteria_ids[$admission_type_id] : array();
        $optionalEligibilityCriteriaIds = array_key_exists($admission_type_id, $request->optional_eligibility_criteria_ids) ? $request->optional_eligibility_criteria_ids[$admission_type_id] : array();

        $data['vertical_id'] = (int)$request->vertical_id;
        $data['admission_type_id'] = $admission_type_id;
        $data['specialization_id'] = $request->specialization_id;
        $data['admission_duration'] = json_encode($admissionDurations);
        $data['is_active'] = $request->is_active[$admission_type_id];
        $data['required_eligibility_criteria_id'] = json_encode($requiredEligibilityCriteriaIds);
        $data['optional_eligibility_criteria_id'] = json_encode($optionalEligibilityCriteriaIds);
        $create = SpecializationVertical::updateOrCreate(['specialization_id' => $request->specialization_id, 'admission_type_id' => $admission_type_id, 'vertical_id' => (int)$request->vertical_id], $data);
      }

      return response()->json([
        'status' => 'success',
        'message' => 'Specialization configued successfully!',
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage(),
      ]);
    }
  }

  public function specializationsByAdmissionTypeSessionVerticalUser(Request $request)
  {
   
    $admissionTypeId = $request->admissionTypeId;
    $verticalId = $request->verticalId;
    $admissionSessionId = $request->admissionSessionId;
    $userId = $request->userId;
    $currentDate = date("Y-m-d");
    $schemeId = 0;
    $admissionSession = AdmissionSession::with('admissionSessionAdmissionTypes')->where('id', $admissionSessionId)->first();
    
    foreach ($admissionSession->admissionSessionAdmissionTypes as $admissionSessionAdmissionType) {
      if ($admissionSessionAdmissionType->admission_type_id == $admissionTypeId) {
        foreach ($admissionSessionAdmissionType->schemes as $scheme) {
          if ($scheme->pivot->start_date <= $currentDate) {
            $schemeId = $scheme->id;
          }
        }
      }
    }
    if (empty($schemeId)) {
      return response()->json([
        'status' => 'error',
        'message' => 'Admission are closed for ' . $admissionSession->name,
      ]);
    }
    
    $allotedSessionToUser = UserSharing::where('user_id', $userId)->where('vertical_id', $verticalId)->where('admission_session_id', $admissionSession->id)->where('start_date', '<=', $currentDate)->orderBy('start_date', 'DESC')->first();
    if ($allotedSessionToUser) {
      $allotedSpecializationIdsToUser = UserSharingFee::where('user_sharing_id', $allotedSessionToUser->id)->where('scheme_id', $schemeId)->pluck('specialization_id')->toArray();
      if (empty($allotedSpecializationIdsToUser)) {
        return response()->json([
          'status' => 'error',
          'message' => 'Admission are closed for ' . $admissionSession->name,
        ]);
      }
    }

    $specializationIds = SpecializationVertical::where('admission_type_id', $admissionTypeId)->where('vertical_id', $verticalId)->pluck('specialization_id')->toArray();

    $specializations = Specialization::whereIn('id', $allotedSpecializationIdsToUser)->whereIn('id', $specializationIds)->with('program', 'department', 'programType', 'mode')->get();

    return response()->json([
      'status' => 'success',
      'data' => $specializations
    ]);
  }
}
