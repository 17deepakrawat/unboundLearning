<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Http\Controllers\Controller;
use App\Models\Academics\Department;
use App\Models\Academics\Program;
use App\Models\Academics\ProgramType;
use App\Models\Academics\Specialization;
use App\Models\Academics\Vertical;
use App\Models\FilterFields;
use App\Models\Settings\Admissions\AdmissionSession;
use App\Models\Settings\Admissions\AdmissionType;
use App\Models\Settings\Components\City;
use App\Models\Settings\Components\Country;
use App\Models\Settings\Components\Language;
use App\Models\Settings\Components\State;
use App\Models\Settings\Leads\AssignmentRule;
use App\Models\Settings\Leads\CustomField;
use App\Models\Settings\Leads\Source;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubSource;
use App\Models\Settings\Leads\SubStage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AssignmentRulesController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view assignment-rules')) {
      if ($request->ajax()) {

        $data = AssignmentRule::orderBy('id', 'desc')->get();

        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME','UTC'))->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.leads.assignment-rules.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create assignment-rules')) {
      $roles = Role::all();
      $users = User::all();
      $verticals = Vertical::all();
      $allFields = CustomField::whereNotIn('type', ['Dependent Dropdown', 'File'])->whereNot('use_for','opportunity')->get();
      // $allFields = FilterFields::whereNot('use_for','opportunity')->get();
      return view('settings.leads.assignment-rules.create', compact(['roles', 'users', 'allFields','verticals']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public static function addFilter($values = '', $field = '', $count = '')
  {
    $allFields = CustomField::whereNotIn('type', ['Dependent Dropdown', 'File'])->whereNot( 'use_for','opportunity')->get();
    // $allFields = FilterFields::whereNot( 'use_for','opportunity')->get();
    return view('settings.leads.assignment-rules.filter', compact('allFields', 'values', 'field', 'count'));
  }
  public static function addFilterForApplication($values = '', $field = '', $count = '',$view='')
  {
    $allFields = CustomField::whereNotIn('type', ['Dependent Dropdown', 'File'])->whereNot( 'use_for','lead')->get();
    // $allFields = FilterFields::whereNot( 'use_for','lead')->get();
    return view('settings.leads.assignment-rules.filter', compact('allFields', 'values', 'field', 'count'));
  }

  public static function fieldValue($id, $val = '')
  {
    $field = CustomField::where('schema', $id)->first();
    if ($field->is_core_field == 1) {
      if (strtolower($field->schema) == 'source_id') {
        $sources = Source::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($sources as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      } else if (strtolower($field->schema) == 'sub_source_id') {
        $subSource = SubSource::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($subSource as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      } elseif (strtolower($field->schema) == 'vertical_id') {
        $vertical = Vertical::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($vertical as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value->fullName . '</option>';
        }
        $option .= '</select>';
        return $option;
      } elseif (strtolower($field->schema) == 'program_id') {
        $program = Program::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($program as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      } elseif (strtolower($field->schema) == 'specialization_id') {
        $specialization = Specialization::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($specialization as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      elseif (strtolower($field->schema) == 'language_id') {
        $languages = Language::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($languages as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      elseif (strtolower($field->schema) == 'stage_id') {
        $stages = Stage::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($stages as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      elseif (strtolower($field->schema) == 'sub_stage_id') {
        $subStages = SubStage::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($subStages as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='phone')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='mobile')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='gender')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='planning_to_stat_in')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='for_whom')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='last_qualification')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='email')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='alternate_email')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='address')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='last_name')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='source_campaign')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='source_medium')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='ad_group')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='ad_name')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='website')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='origin')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='can_login')
      {
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        $option .= '<option value=1>Yes</option>';
        $option .= '<option value=0>No</option>';
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='first_name')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='date_of_birth')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="date" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='phone_verified_on')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="date" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='email_verified_on')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="date" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='duration')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
      else if(strtolower($field->schema)=='admission_type_id')
      {
        $admissionType = AdmissionType::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($admissionType as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='admission_session_id')
      {
        $admissionSession = AdmissionSession::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($admissionSession as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='user_id')
      {
        $user = User::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($user as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='program_type_id')
      {
        $programType = ProgramType::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($programType as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='department_id')
      {
        $department = Department::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($department as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='country_id')
      {
        $country = Country::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($country as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='state_id')
      {
        $state = State::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($state as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='city_id')
      {
        $city = City::all();
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        foreach ($city as $key => $value) {
          $selected = '';
          if ($val != '' &&  in_array($value['id'], $val)) {
            $selected = 'selected';
          }
          $option .= '<option value="' . $value['id'] . '" ' . $selected . ' >' . $value['name'] . '</option>';
        }
        $option .= '</select>';
        return $option;
      }
      else if(strtolower($field->schema)=='zip_code')
      {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
    } else {
      if ($field->type == 'Dropdown') {
        $option = '';
        $fieldset = json_decode($field->options, true);
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select  name="filter_value[' . $field->schema . '][]" title="Field Value" id="filter_value_' . $field->schema . '" class="form-control form-select required" >';
        $option .= '<option value="">Choose</option>';
        if ($fieldset) {

          foreach ($fieldset as $key => $value) {
            $selected = '';
            if ($val != '' &&  in_array($value, $val)) {
              $selected = 'selected';
            }
            $option .= '<option value="' . $value . '" ' . $selected . ' >' . $value . '</option>';
          }
        }
        $option .= '</select>';
        return $option;
      } elseif ($field->type == 'Text') {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" value="' . $val . '" >';
        return $inputbox;
      } elseif ($field->type == 'Textarea') {
        $textarea = '';
        $textarea .= '<label class="form-label">Field Value</label>';
        $textarea .= '<textarea rows="1" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"   class="form-control required" >' . $val . '</textarea>';
        return $textarea;
      } elseif ($field->type == 'Phone') {
        $Phone = '';
        $Phone .= '<label class="form-label">Field Value</label>';
        $Phone .= '<input type="number" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"  class="form-control required" maxlength="10" value="' . $val . '"  >';
        return $Phone;
      } elseif ($field->type == 'Email') {
        $Email = '';
        $Email .= '<label class="form-label">Field Value</label>';
        $Email .= '<input type="email" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"  class="form-control required" value="' . $val . '" >';
        return $Email;
      } elseif ($field->type == 'Date') {
        $Date = '';
        $Date .= '<label class="form-label">Field Value</label>';
        $Date .= '<input type="date" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"  class="form-control required" value="' . $val . '" >';
        return $Date;
      } elseif ($field->type == 'Boolean') {
        $option = '';
        $option .= '<label class="form-label">Field Value</label>';
        $option .= '<select name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"  class="form-control form-select required" >';
        $option .= '<option value="1">Yes</option>';
        $option .= '<option value="0">No</option>';
        $option .= '</select>';
        // dd($option);
        return $option;
      } else {
        $inputbox = '';
        $inputbox .= '<label class="form-label">Field Value</label>';
        $inputbox .= '<input type="text" name="filter_value[' . $field->schema . ']" title="Field Value" id="filter_value_' . $field->schema . '"  class="form-control required" value="' . $val . '" >';
        return $inputbox;
      }
    }
  }

  public function store(Request $request)
  {

    if (Auth::check() && Auth::user()->hasPermissionTo('create assignment-rules')) {
      try {
        $data = $request->all();
        $storedata['name'] = $data['name'];
        $rule['then']['role_ids'] = $data['role_ids'];
        $rule['then']['distribution_rule'] = $data['distribution_rule'];
        if (isset($data['user_ids'])) {
          $rule['then']['user_ids'] = $data['user_ids'];
        }
        for ($i = 0; $i < count($request->filter_on); $i++) {
          $rule['if'][$i]['schema'] =  $request->filter_on[$i];
          $rule['if'][$i]['operator'] =  $request->filter_type[$i];
          $rule['if'][$i]['value'] =  $request->filter_value[$request->filter_on[$i]];
        }

        $storedata['rule'] = json_encode($rule);
        $storedata['vertical_id'] = $request->vertical_id;
        $store = AssignmentRule::create($storedata);
        return response()->json([
          'status' => 'success',
          'message' => 'Assigne Rule Created'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    }
  }

  public function status($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit assignment-rules')) {
      try {
        $assignment = AssignmentRule::findOrFail($id);
        if ($assignment) {
          $assignment->is_active = $assignment->is_active == 1 ? 0 : 1;
          $assignment->save();
          return response()->json([
            'status' => 'success',
            'message' => $assignment->name . ' status updated successfully!',
          ]);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Source not found',
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

  public function edit($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit assignment-rules')) {
      $roles = Role::all();
      $users = User::all();
      $assignment = AssignmentRule::where('id', $id)->get();
      $rules = json_decode($assignment[0]->rule, true);
      // dd($rules);
      $fields = '';
      foreach ($rules['if'] as $key => $rule) {
        if (isset($rule['value']) && !empty($rule['value'])) {
          $val = $rule['value'];
          $field_value = $this->fieldValue($rule['schema'], $val);
          $fields .= $this->addFilter($rule, $field_value, $key);
        }
      }
      return view('settings.leads.assignment-rules.edit', compact(['roles', 'users', 'rules', 'assignment', 'fields']));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function update(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create assignment-rules')) {
      try {
        $data = $request->all();
        $storedata['name'] = $data['name'];
        $rule['then']['role_ids'] = $data['role_ids'];
        $rule['then']['distribution_rule'] = $data['distribution_rule'];
        if (isset($data['user_ids'])) {
          $rule['then']['user_ids'] = $data['user_ids'];
        }
        for ($i = 0; $i < count($request->filter_on); $i++) {
          $rule['if'][$i]['schema'] =  $request->filter_on[$i];
          $rule['if'][$i]['operator'] =  $request->filter_type[$i];
          $rule['if'][$i]['value'] = $request->filter_value[$request->filter_on[$i]];
        }

        $storedata['rule'] = json_encode($rule);
        AssignmentRule::where('id', $id)->update($storedata);
        return response()->json([
          'status' => 'success',
          'message' => 'Assignment Rule Updated!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    }
  }
}
