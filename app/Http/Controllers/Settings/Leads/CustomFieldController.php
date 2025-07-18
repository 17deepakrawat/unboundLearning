<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Models\Settings\Leads\CustomField;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Helpers;

class CustomFieldController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view custom-fields')) {
      if ($request->ajax()) {

        $data = CustomField::orderBy('id', 'desc')->get();
        return DataTables::of($data)
          ->addIndexColumn()
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
            return $formatedDate;
          })
          ->make(true);
      }
      return view('settings.leads.custom-fields.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create($use_for)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create custom-fields')) {
      $dropdown = CustomField::where('is_active', 1)->where('type', 'DropDown')->where('is_multiple', 0)->where('is_core_field',0)->get();
      $dependentDropdownsParentIds = CustomField::where('is_active',1)->where('type', 'Dependent Dropdown')->get('dependent');
      $dependentIds = array_column($dependentDropdownsParentIds->toArray(),'dependent');
      $dependentIds = array_filter($dependentIds);
      $dependentIds = array_unique($dependentIds);
      $dropdown = array_filter($dropdown->toArray(), function ($item) use ($dependentIds) {
        return !in_array($item['id'], $dependentIds);
      });
      return view('settings.leads.custom-fields.create', compact('dropdown', 'use_for'));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create custom-fields')) {
      try {
        $slug = Helpers::createCustomFieldSchema($request->name);
        $check = CustomField::where('schema', $slug)->count();
        if ($check > 0) {
          $message = $request->name . ' already exist!';
          return response()->json([
            'status' => 'error',
            'message' => $message,
          ]);
        }

        if ($request->dependent != null) {
          foreach ($request->options as $key => $options) {
            $optionsJson = preg_split('/\r\n|[\r\n]/', $options[0]);
            $dependentOption[$key] = $optionsJson;
          }
          $request->request->set('options', json_encode($dependentOption, true));
        } else {
          if ($request->options != null) {
            $options = preg_split('/\r\n|[\r\n]/', $request->options);
            $request->request->set('options', json_encode($options, true));
          }
        }
        if (isset($request->extension) && !empty($request->extension)) {
          $request->request->set('extension', json_encode($request->extension));
        }

        $request->request->add(['schema' => $slug]);
        if (!isset($request->use_for) && $request->use_for == '') {
          $request->request->set('use_for', 'custom_filed');
        }

        if ($request->type == 'Dropdown') {
          $request->request->set('max_selection', $request->max_selection);
          $request->request->set('pre_selected_options', json_encode(preg_split('/\r\n|[\r\n]/', $request->pre_selected_options), true));
        }

        $customFields = CustomField::create($request->all());
        if ($customFields) {
          $tableName = 'opportunity_custom_fields';

          $fieldConfigs = array(
            "Text" => array("type" => "string", "length" => "255"),
            "Textarea" => array("type" => "longtext", "length" => ""),
            "Phone" => array("type" => "string", "length" => "25"),
            "Email" => array("type" => "string", "length" => "255"),
            "Dropdown" => array("type" => "string", "length" => "255"),
            "Date" => array("type" => "date", "length" => ""),
            "Time" => array("type" => "time", "length" => ""),
            "Date Time" => array("type" => "timestamp", "length" => ""),
            "Dependent Dropdown" => array("type" => "string", "length" => "255"),
            "Boolean" => array("type" => "boolean", "length" => ""),
            "File" => array("type" => "text", "length" => "255"),
            "Number" => array("type" => "integer", "length" => ""),
            "Decimal" => array("type" => "float", "length" => ""),
          );
          $fieldConfig = $fieldConfigs[$request->type];
          self::createCustomFieldColumnInTable($tableName, $slug, $fieldConfig);
        }
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' created successfully!',
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

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit custom-fields')) {
      $customFields = CustomField::find($id);
      $dropdown = CustomField::where('is_active', 1)->where('type', 'DropDown')->where('is_multiple', 0)->where('is_core_field',0)->get();
      $dependentDropdownsParentIds = CustomField::where('is_active', 1)->where('type', 'Dependent Dropdown')->where('id', '!=', $id)->get('dependent');
      $dependentIds = array_column($dependentDropdownsParentIds->toArray(),'dependent');
      $dependentIds = array_filter($dependentIds);
      $dependentIds = array_unique($dependentIds);
      $dropdown = array_filter($dropdown->toArray(), function ($item) use ($dependentIds) {
        return !in_array($item['id'], $dependentIds);
      });
      return view('settings.leads.custom-fields.edit', compact('customFields', 'dropdown'));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit custom-fields')) {
      try {
        if ($request->dependent != null) {
          foreach ($request->options as $key => $options) {
            $optionsJson = preg_split('/\r\n|[\r\n]/', $options[0]);
            $dependentOption[$key] = $optionsJson;
          }
          $request->request->set('options', json_encode($dependentOption, true));
        } else {
          if ($request->options != null) {
            $options = preg_split('/\r\n|[\r\n]/', $request->options);
            $request->request->set('options', json_encode($options, true));
          }
        }
        $request->request->remove('_method');
        $request->request->remove('_token');

        if ($request->type == 'Dropdown') {
          $request->request->set('max_selection', $request->max_selection);
          $request->request->set('pre_selected_options', json_encode(preg_split('/\r\n|[\r\n]/', $request->pre_selected_options), true));
        }

        $customFields = CustomField::where('id', $id)->update($request->all());
        return response()->json([
          'status' => 'success',
          'message' => $request->name . ' updated successfully!',
        ]);
      } catch (\Exception $e) {
        $message = $e->getMessage();
        return response()->json([
          'status' => 'error',
          'message' => $message,
        ]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(CustomField $customFields)
  {
    //
  }
  public function status($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit custom-fields')) {
      try {
        $source = CustomField::findOrFail($id);
        if ($source) {
          $source->is_active = $source->is_active == 1 ? 0 : 1;
          $source->save();
          return response()->json([
            'status' => 'success',
            'message' => $source->name . ' status updated successfully!',
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
  public static function createCustomFieldColumnInTable($tableName, $columnName, $fieldConfig)
  {
    $length = $fieldConfig['length'];
    $type = $fieldConfig['type'];
    return Schema::table($tableName, function (Blueprint $table) use ($type, $length, $columnName) {
      if (!empty($length)) {
        $table->$type($columnName, $length)->nullable();
      } else {
        $table->$type($columnName)->nullable();
      }
    });
  }

  public static function generateHTML($id = '', $use_for = '', $table = 'opportunity_custom_fields', $column = 'lead_id', $withId = false)
  {
    if ($use_for != '') {
      $allFields = CustomField::where('is_active', 1)->where('use_for', $use_for)->get();
    } else {
      $allFields = CustomField::where('is_active', 1)->get();
    }
    $returnHTML = [];
    if ($id != '') {
      $allFieldsData =  DB::table($table)->where($column, $id)->get();
    }
    if (!empty($allFields)) {
      foreach ($allFields as $field) {
        $value = '';
        $html = '';
        $field_key = str_replace(' ', '_', $field['name']);
        if ($id != '' && $allFieldsData->count()>0 && array_key_exists($field_key, (array)$allFieldsData[0]) && $allFieldsData[0]->$field_key != null) {
          $value = $allFieldsData[0]->$field_key;
        }
        $mandatory = $field['mandatory'] == 1 ? "required" : "";
        if ($field['type'] == 'Text') {
          $extraClass = '';
          if ($field['validation'] == 'Only Alpha Charecters') {
            $extraClass = "onlyalpha allowtextonly";
          } else if ($field['validation'] == 'Alpha Numeric') {
            $extraClass = 'alphannumeric';
          }
          $html .= '<label class="form-label">' . $field['name'] . '</label>';
          $html .= '<input type="text" class="form-control ' . $extraClass . ' ' . $mandatory . '" id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" maxlength="' . $field['size'] . '" value="' . $value . '" ' . $mandatory . ' >';
        } elseif ($field['type'] == 'Textarea') {
          $html = '<label class="form-label">' . $field['name'] . '</label>';
          $html .= '<textarea type="text" class="form-control  ' . $mandatory . '" id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' >' . $value . '</textarea>';
        } elseif ($field['type'] == 'Phone') {
          $extraclass = '';
          if ($field['is_intl_phone'] == 1) {
            $extraClass = 'intltelinput';
          }
          $html = '<label class="form-label">' . $field['name'] . '</label>';
          $html .= '<input type="tel" class="form-control allownumbervalue checkmobileno ' . $extraClass . '  ' . $mandatory . '" id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' maxlength="' . $field['size'] . '" value="' . $value . '">';
        } elseif ($field['type'] == 'Email') {
          $html = '<label class="form-label">' . $field['name'] . '</label>';
          $html .= '<input type="email" class="form-control email checkemail" id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' maxlength="' . $field['size'] . '" value="' . $value . '">';
        } elseif ($field['type'] == 'Dropdown') {
          $multiple = $field['is_multiple'] == 1 ? "multiple" : "";
          $multiname = $multiple != "" ? "[]" : "";
          $optionsArr = json_decode($field['options'], true);
          $opt = '<option value>Choose<option>';
          if (!empty($optionsArr)) {
            foreach ($optionsArr as $option) {
              $selected = '';
              if ($field['is_multiple'] == 1 && $value != '') {
                $selectedData = json_decode($value, true);
                if (in_array($option, $selectedData)) {
                  $selected = "selected";
                }
              } else {
                if ($value != '' && $value == $option) {
                  $selected =  "selected";
                }
              }
              $opt .= '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
            }
          }
          $html = '<label class="form-label">' . $field['name'] . '</label>';
          $html .= '<select class="form-control select2" ' . $multiple . ' ' . $mandatory . ' id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . $multiname . '" onchange=getDependentOptions("' . $field_key . '")>';
          $html .= $opt;
          $html .= '</select>';
        } elseif ($field['type'] == 'Date') {
          $html = '<label class="form-label w-100">' . $field['name'] . '</lable>';
          $html .= '<input type="date" class="form-control datepicker w-100 " id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' value="' . $value . '">';
        } elseif ($field['type'] == 'Time') {

          $html = '<label class="form-label w-100">' . $field['name'] . '</lable>';
          $html .= '<input type="time" class="form-control datepicker w-100" id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' value="' . $value . '">';
        } elseif ($field['type'] == 'Date Time') {
          $html = '<label class="form-label w-100">' . $field['name'] . '</lable>';
          $html .= '<input type="datetime-local" class="form-control datepicker w-100" id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' value="' . $value . '">';
        } elseif ($field['type'] == 'Dependent Dropdown') {
          $multiple = $field['is_multiple'] == 1 ? "multiple" : "";
          $multiname = $multiple != "" ? "[]" : "";

          $html = '<label class="form-label">' . $field['name'] . '</label>';
          $html .= '<select class="form-control select2" ' . $multiple . ' ' . $mandatory . ' id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . $multiname . '" data-dependent-id="' . $field['dependent'] . '">';
          $html .= '<option vlaue=""></option>';
          $html .= '</select>';
        } elseif ($field['type'] == 'Boolean') {
          $checkedYes = '';
          $checkedYes = $value == 1 ? "checked" : "";
          switch ($field['sub_type']) {
            case 'Radio':
              $html = '<label>' . $field['name'] . '</label>&nbsp;&nbsp;&nbsp;';
              $html .= '<input type="radio" class="" name="__udf__' . $field['schema'] . '" value="1" ' . $checkedYes . '>';
              break;
            case 'Check Box':
              $html = '<label>' . $field['name'] . '</label>&nbsp;&nbsp;&nbsp;';
              $html .= '<input type="checkbox" class="" name="__udf__' . $field['schema'] . '" value="1" ' . $checkedYes . '>';
              break;
            default:
              '';
          }
        } elseif ($field['type'] == "File") {
          $multiple = $field['is_multiple'] == 1 ? 'multiple' : '';
          $ext = implode(',', json_decode($field['extension'], true));
          $html = '<label>' . $field['name'] . '</label>';
          $html .= '<input type="file" class="form-control" id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' ' . $multiple . ' size="' . $field['size'] . '" data-ext="' . $ext . '">';
        }
        elseif($field['type']=="Number")
        {
          $html = '<label class="form-label w-100">' . $field['name'] . '</lable>';
          $html .= '<input type="number" class="form-control w-100 " id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' value="' . $value . '">';
        }
        elseif($field['type']=="Decimal")
        {
          $html = '<label class="form-label w-100">' . $field['name'] . '</lable>';
          $html .= '<input type="number" class="form-control w-100 " id="__udf__' . $field['schema'] . '" name="__udf__' . $field['schema'] . '" ' . $mandatory . ' value="' . $value . '" step="any">';
        }
        if ($withId) {
          $returnHTML[$field['id']] = $html;
        } else {
          $returnHTML[] = $html;
        }
      }
      return $returnHTML;
    }
  }

  public function getDependentOptions($id, $fieldid)
  {
    $options = CustomField::where('id', $id)->get('options');
    if ($fieldid == 0) {
      $optionsHtml = '';
      foreach (json_decode($options[0]['options'], true) as $value) {
        $optionsHtml .= '<div class="col-md-12"><label class="form-label" for="name">' . $value . '</label><textarea name="options[' . $value . '][]" id="options[]" cols="30" rows="5" class="form-control"></textarea></div>';
      }
    } else {
      $optionValues = CustomField::where('id', $fieldid)->get('options');
      $values = json_decode($optionValues->toArray()[0]['options'], true);

      $optionsHtml = '';
      foreach (json_decode($options[0]['options'], true) as $value) {
        $textareaValue = trim(implode("\r\n", $values[$value]));
        $optionsHtml .= '<div class="col-md-12"><label class="form-label" for="name">' . $value . '</label><textarea name="options[' . $value . '][]" id="options[]" cols="30" rows="5" class="form-control">' . $textareaValue . '</textarea></div>';
      }
    }
    return $optionsHtml;
  }

  public function dependentFiledValues($parentValue, $childId)
  {
    $child = CustomField::find($childId);
    $options = json_decode($child->options, true);
    $options = array_key_exists($parentValue, $options) ? $options[$parentValue] : array();

    return response()->json(['status' => 'success', 'data' => $options, 'childSchema' => $child->schema]);
  }
}
