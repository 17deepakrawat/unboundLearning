<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Models\Academics\ApplicationFields;
use App\Models\Academics\ApplicationRule;
use App\Models\Academics\ApplicationSteps;
use App\Models\Leads\Opportunity;
use App\Models\Settings\Leads\CustomField;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use setasign\Fpdi\Fpdi;

class ApplicationFormController extends Controller
{
  //
  public function index(Request $request) {}

  public function generateApplicationForm($verticalId)
  {
    return view("academics.verticals.application.form-designer", compact('verticalId'));
  }

  public function applicationFormSteps($verticalId)
  {
    $steps = ApplicationSteps::where('vertical_id', $verticalId)->with('fields')->orderBy('position')->get();
    return response()->json($steps);
  }

  public function customFields($verticalId)
  {
    $customFields = CustomField::with('parent', 'child')->get();
    return response()->json($customFields);
  }

  public function createStep($verticalId)
  {
    return view('academics.verticals.application.steps.create', compact('verticalId'));
  }

  public function editStep($id)
  {
    $step = ApplicationSteps::where('id', $id)->first();
    return view('academics.verticals.application.steps.edit', compact('step'));
  }

  public function storeStep(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create application-form')) {
      try {
        if (isset($request->id) && $request->id > 0) {
          $step = ApplicationSteps::find($request->id);
          $step->title = $request->title;
          $step->save();
        } else {
          $position = ApplicationSteps::where('vertical_id', $request->vertical_id)->count();

          $step = new ApplicationSteps();
          $step->title = $request->title;
          $step->vertical_id = $request->vertical_id;
          $step->position = $position + 1;
          $step->save();
        }
        return response()->json([
          'status' => 'success',
          'message' => 'Step saved successfully!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    }
  }

  public function updateStepPosition(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit application-form')) {
      try {
        $step = ApplicationSteps::find($request->step_id);
        $step->position = $request->position;
        $step->save();
        return response()->json([
          'status' => 'success',
          'message' => 'Step updated successfully!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    }
  }

  public function statusSteps($id)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit application-form')) {
      try {
        $step = ApplicationSteps::where('id', $id)->first();
        $is_active = $step->is_active == 1 ? 0 : 1;
        $update = ApplicationSteps::where('id', $id)->update(['is_active' => $is_active]);
        return response()->json([
          'status' => 'success',
          'message' => 'Step status updated'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    }
  }

  public function storeFields(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit application-form')) {
      try {

        $applicationField = ApplicationFields::where('vertical_id', $request->vertical_id)->where('field_id', $request->field_id)->first();
        if ($applicationField) {
          $applicationField->update($request->all());
        } else {
          ApplicationFields::create($request->all());
        }

        return response()->json([
          'status' => 'success',
          'message' => 'Field is successfully mapped!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    }
  }

  public function removeField(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit application-form')) {
      try {
        $applicationField = ApplicationFields::where('vertical_id', $request->vertical_id)->where('step_id', $request->step_id)->where('field_id', $request->field_id)->delete();
        return response()->json([
          'status' => 'success',
          'message' => 'Field removed successfully!'
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'error',
          'message' => $e->getMessage()
        ]);
      }
    }
  }

  public static function createMultipleColumnsInTable()
  {
    $allfields = ApplicationFields::with('customFields')->get();
    if (count($allfields->toArray()) > 0) {
      Schema::table('application_forms', function (Blueprint $table) use ($allfields) {
        foreach ($allfields->toArray() as $key => $value) {
          if (!(Schema::hasColumn('application_forms', $value['custom_fields']['schema']))) {
            $table->string($value['custom_fields']['schema'], 255)->nullable();
          }
        }
      });
    }
  }

  public function applicationFormRules($verticalId)
  {
    $rules = ApplicationRule::where('vertical_id', $verticalId)->get();
    return view('academics.verticals.application.rules.index', compact('verticalId', 'rules'));
  }

  public function createRule($verticalId)
  {
    return view('academics.verticals.application.rules.create', compact('verticalId'));
  }

  public function getFields($verticalId)
  {
    $fields = ApplicationFields::where('vertical_id', $verticalId)->with('customFields')->get();
    $customFields = array_map(function ($field) {
      if ($field['custom_fields']['type'] !== 'File') {
        return [
          'id' => $field['custom_fields']['id'],
          'name' => $field['custom_fields']['name'],
        ];
      }
    }, $fields->toArray());
    return response()->json($customFields);
  }

  public function getValueDom($verticalId)
  {
    $fieldId = request()->field_id;
    $operator = request()->operator;
  }

  public function conditionOperators($verticalId)
  {
    $fieldId = request()->field_id;
    $customField = CustomField::where('id', $fieldId)->first();
    if ($customField->type == 'Text') {
      $operators = [
        'equal' => 'Equal',
        'not_equal' => 'Not Equal',
        'contains' => 'Contains',
        'not_contains' => 'Not Contains',
        'is_empty' => 'Is Empty',
        'is_not_empty' => 'Is Not Empty',
      ];
    } elseif ($customField->type == 'Number') {
      $operators = [
        'equal' => 'Equal',
        'not_equal' => 'Not Equal',
        'greater_than' => 'Greater Than',
        'less_than' => 'Less Than',
        'greater_than_or_equal' => 'Greater Than or Equal',
        'less_than_or_equal' => 'Less Than or Equal',
        'between' => 'Between',
        'not_between' => 'Not Between',
      ];
    } elseif ($customField->type == 'Date') {
      $operators = [
        'equal' => 'Equal',
        'not_equal' => 'Not Equal',
        'greater_than' => 'Greater Than',
        'less_than' => 'Less Than',
        'greater_than_or_equal' => 'Greater Than or Equal',
        'less_than_or_equal' => 'Less Than or Equal',
        'between' => 'Between',
        'not_between' => 'Not Between',
      ];
    } elseif ($customField->type == 'Dropdown') {
      $operators = [
        'equal' => 'Equal to',
        'not_equal' => 'Not Equal to',
        'in' => 'In',
        'not_in' => 'Not In',
      ];
    } else {
      $operators = [
        'equal' => 'Equal',
        'not_equal' => 'Not Equal',
        'contains' => 'Contains',
        'not_contains' => 'Not Contains',
        'is_empty' => 'Is Empty',
        'is_not_empty' => 'Is Not Empty',
      ];
    }

    return response()->json($operators);
  }

  public function storeRule(Request $request)
  {
    // dd($request->all());
  }

  public function printApplicationForm($opportunityId)
  {
         
      try{
        $opportunity = Opportunity::where('id',$opportunityId)->with('vertical','opportunityCustomFields','program','specialization','admissionSession','admissionType','lead','applicationOwner')->first();
        if($opportunity->vertical->short_name=="JAMIA")
        {
          $pdf = new Fpdi();
          $pdf->SetTitle('Jamia Application Form');

          // Load the existing PDF file
          $file = public_path('uploads/application-form/jamia-form.pdf');
          $pageCount = $pdf->setSourceFile($file);

          // Import the first page of the template
          $pageId = $pdf->importPage(1);
          $pdf->AddPage();
          $pdf->useTemplate($pageId, 0, 0, 210);

          // Set font and add dynamic content
          $pdf->SetFont('Arial', '', 11);

          $monthName = Carbon::create()->month($opportunity->admissionSession->month)->format('M');
          // Example: Session field (adjust XY based on your form layout)
          $pdf->SetXY(153, 46.5);
          $pdf->Write(1, $monthName .'/'.$opportunity->admissionSession->year ?? "");
          
          $enrollment_no = str_split($opportunity['student_id']);
          $pdf->SetXY(67, 170.5);
          $pdf->Write(1, $opportunity['student_id']);
          $check = public_path('uploads/application-form/checked.png');
          if ($opportunity['specialization']['name']  == 'Commerce') {
            $pdf->SetXY(15, 102);
            $pdf->Write(1, strtoupper('adeeb-e-mahir (Commerce)'));
            $pdf->Image($check, 67, 110, 4, 4);
          } else if ($opportunity['specialization']['name']  == 'Science') {
            $pdf->SetXY(15, 102);
            $pdf->Write(1, strtoupper('adeeb-e-mahir (Science)'));
            $pdf->Image($check, 90, 110, 4, 4);
          } else if ($opportunity['specialization']['name']  == 'Arts') {
            $pdf->SetXY(15, 102);
            $pdf->Write(1, strtoupper('adeeb-e-mahir (Arts)'));
            $pdf->Image($check, 38, 110, 4, 4);
          }else{
            $pdf->SetXY(15, 102);
            $pdf->Write(1, strtoupper($opportunity['specialization']['name']));
          }
          $pdf->Image($check, 130, 156, 4, 4);

          $languageSubjects = json_decode($opportunity->opportunityCustomFields[0]['language_subjects'],true);
          $otherSubjects    = json_decode($opportunity->opportunityCustomFields[0]['other_subjects'],true); 

          $x = 15;
          $y = 121.5;
          foreach($languageSubjects as $key=>$val)
          {
              if ($val == 'Urdu') {
                //$pdf->Image($check, 140, 156, 4, 4);
              } else if ($val == 'English') {
                //$pdf->Image($check, 130, 156, 4, 4);
              } else {
                $pdf->SetXY(42, 157.6);
                $pdf->Write(1, strtoupper($val));
              }
          }
          foreach($otherSubjects as $key=>$value)
          {
            if ($opportunity['specialization']['name']  != 'adeeb') {

              if ($value == 'Biology') {
                $pdf->Image($check, 88, 147, 3, 3);
              } else if ($value == 'Mathematics') {
                $pdf->Image($check, 88, 140, 3, 3);
              } else if ($value == 'Political Science') {
                $pdf->Image($check, 68.5, 135, 3, 3);
              } else if ($value == 'History') {
                $pdf->Image($check, 68.5, 130, 3, 3);
              } else if ($value == 'Geography') {
                $pdf->Image($check, 88, 130, 3, 3);
              } else if ($value == 'Sociology') {
                $pdf->Image($check, 88, 140, 3, 3);
              }
            } else {

              if ($value == 'Mathematics') {
                $pdf->Image($check, 33.5, 132, 3, 3);
              } else if ($value == 'Home Science') {
                $pdf->Image($check, 33.5, 144, 3, 3);
              }
            }
          }
          $photo = json_decode($opportunity->opportunityCustomFields[0]['photo'],true);
          $image = public_path($photo[0]);
          if(file_exists($image))
          {
            $pdf->Image($image, 13, 22.3, 30.5, 35.9);
          }

          $student_name = str_split(str_replace('  ', ' ', $opportunity->name));

          $x = 51;
          $y = 194.7;
          foreach ($student_name as $name) {
            if ($x > 190) {
              $y = $y + 5;
              $x = 51;
              $pdf->SetXY($x, $y);
            } else {
              $pdf->SetXY($x, $y);
            }
            $pdf->Write(1, $name);
            $x += 7.7;
          }


          $father_name = str_split($opportunity->opportunityCustomFields[0]['father_name']);
          $x = 51;

          foreach ($father_name as $name) {
            $pdf->SetXY($x, 218);
            $pdf->Write(1, $name);
            $x += 7.7;
          }

          // Mother Name
          $mother_name = str_split($opportunity->opportunityCustomFields[0]['mother_name']);
          $x = 51;
          foreach ($mother_name as $name) {
            $pdf->SetXY($x, 235.4);
            $pdf->Write(1, $name);
            $x += 7.7;
          }

          // // DOB
          $dob = str_split($opportunity->lead['date_of_birth']);
          // Day
          $pdf->SetXY(54.5, 245);
          $pdf->Write(1, $dob[8]);
          $pdf->SetXY(61.5, 245);
          $pdf->Write(1, $dob[9]);
          // Month
          $pdf->SetXY(73, 245);
          $pdf->Write(1, $dob[5]);
          $pdf->SetXY(80, 245);
          $pdf->Write(1, $dob[6]);
          // Year
          $pdf->SetXY(88, 245);
          $pdf->Write(1, $dob[0]);
          $pdf->SetXY(96, 245);
          $pdf->Write(1, $dob[1]);
          $pdf->SetXY(103, 245);
          $pdf->Write(1, $dob[2]);
          $pdf->SetXY(110, 245);
          $pdf->Write(1, $dob[3]);

          // // Gender
          $gender = $opportunity->lead['gender'] == "Male" ? "Male" : "Female";
          if ($gender == "Male") {
            $pdf->Image($check, 151, 244, 2, 3);
          } else if ($gender == "Female") {
            $pdf->Image($check, 172, 243, 2, 3);
          } else {
            $pdf->Image($check, 192, 243, 2, 3);
          }


          $pdf->SetXY(15, 258);
          $pdf->Write(1, strtoupper($opportunity['applicationOwner']['name']));


          //Page 2 start
          // Page 2
          $pageId = $pdf->importPage(2);
          $pdf->addPage();
          $pdf->useImportedPage($pageId, 0, 0, 210);

          if ($opportunity->opportunityCustomFields[0]['category'] == 'General') {
            $pdf->Image($check, 55, 25, 2, 3);
          } else if ($opportunity->opportunityCustomFields[0]['category'] == 'ST') {
            $pdf->Image($check, 100, 25, 2, 3);
          } else if ($opportunity->opportunityCustomFields[0]['category'] == 'SC') {
            $pdf->Image($check, 78, 25, 2, 3);
          } else if ($opportunity->opportunityCustomFields[0]['category'] == 'OBC') {
            $pdf->Image($check, 125, 25, 2, 3);
          }
      
          if ($opportunity->opportunityCustomFields[0]['employment_status'] == 'Govt Employed') {
            $pdf->Image($check, 78, 37, 2, 3);
          } else if ($opportunity->opportunityCustomFields[0]['employment_status'] == 'Employed') {
            $pdf->Image($check, 125, 37, 2, 3);
          } else if ($opportunity->opportunityCustomFields[0]['employment_status'] == 'Unemployed') {
            $pdf->Image($check, 161, 37, 2, 3);
          } else if ($opportunity->opportunityCustomFields[0]['employment_status'] == 'Others') {
            $pdf->Image($check, 190, 37, 2, 3);
          }
      
          if ($opportunity->opportunityCustomFields[0]['nationality'] == 'Indian') {
            $pdf->Image($check, 42, 97, 2, 3);
          } else if ($opportunity->opportunityCustomFields[0]['nationality'] == 'NRI') {
            $pdf->Image($check, 60, 97, 2, 3);
          }

          $address = $opportunity->lead['address'];
          $pdf->SetXY(45, 53);
          $pdf->Write(1, substr($address, 0, 63));
          $pdf->SetXY(11, 63);
          $pdf->Write(1, substr($address, 64));
          // City
          $pdf->SetFont('Arial', '', 10);
          $pdf->SetXY(11, 72);
          $pdf->Write(1, strtoupper(substr($opportunity->lead['city'], 0, 15) . ', ' . $opportunity->opportunityCustomFields[0]['district'] . ', ' . $opportunity->lead['state'] . ', ' . $opportunity->lead['country'] ));
      
          // City
          //$pdf->SetFont('Arial', '', 10);
          //$pdf->SetXY(110, 62.5);
          //$pdf->Write(1, substr($address['present_state'], 0, 18));
      
          // Country
          //$pdf->SetXY(11, 72);
          //$pdf->Write(1, $student['Nationality']);
      
          // Pincode
          $permanent_pincode = str_split($opportunity->lead['zip_code']);
          $x = 151;
          for ($i = 0; $i < count($permanent_pincode); $i++) {
            $pdf->SetXY($x, 73.4);
            $pdf->Write(1, $permanent_pincode[$i]);
            $x += 8.5;
          }

          // Adhaar
          $pdf->SetXY(85, 86);
          $pdf->Write(1, 'Aadhar Card : ' . $opportunity->opportunityCustomFields[0]['aadhar']);

          // Mobile
          $contact = str_split($opportunity->lead['phone']);
          $x = 132;
          for ($i = 0; $i < count($contact); $i++) {
            $pdf->SetXY($x, 99);
            $pdf->Write(1, $contact[$i]);
            $x += 7;
          }
          $signatureImage = json_decode($opportunity->opportunityCustomFields[0]['students_signature'],true);
          if(file_exists($signatureImage[0]))
          {
            $pdf->Image($signatureImage[0], 18, 220, 30.2, 15);
          }
          
          ///academics data print

          $y = '165';
            $x = '11';
      
              // $pdf->SetXY($x, $y);
              // $pdf->Write(1, $academic);
              $x += 3;
              $pdf->SetXY($x, $y);
              $pdf->Write(1, !empty($opportunity->opportunityCustomFields[0]['high_school_result']) ? $opportunity->opportunityCustomFields[0]['high_school_result'] : '');
              
              $x += 52;
                  $pdf->SetXY($x, $y);
                  $pdf->Write(1, !empty($opportunity->opportunityCustomFields[0]['high_school_subjects']) ? $opportunity->opportunityCustomFields[0]['high_school_subjects'] : '');
                  
                  $x += 50;
                  $pdf->SetXY($x, $y);
                  $pdf->Write(1, !empty($opportunity->opportunityCustomFields[0]['high_school_year']) ? $opportunity->opportunityCustomFields[0]['high_school_year'] : '');
                  
                  $x += 20;
                  $pdf->SetXY($x, $y);
                  $pdf->Write(1, !empty($opportunity->opportunityCustomFields[0]['high_school_boarduniversity']) ?
                    substr($opportunity->opportunityCustomFields[0]['high_school_boarduniversity'], 0, 28) : '');
          
                  $x += 30;
                  $pdf->SetXY($x, $y);
                  $pdf->Write(1, !empty($opportunity->opportunityCustomFields[0]['high_school_type']) ? strtoupper(substr($opportunity->opportunityCustomFields[0]['high_school_type'], 0, 28)) : '');
          
                  // Roll No
                  $x += 0;
                  $pdf->SetXY($x, $y);
                  $pdf->Write(1, !empty($opportunity->opportunityCustomFields[0]['high_school_marks']) ? $opportunity->opportunityCustomFields[0]['high_school_marks'] : '');
          // Output the filled PDF as an inline response
          $pdfContent = $pdf->Output('S');

          return response($pdfContent, 200, [
              'Content-Type' => 'application/pdf',
              'Content-Disposition' => 'inline; filename="Jamia Application Form.pdf"',
          ]);
        }
        else
        {
          return response('Form Not Configure!',400);
        }
     }
     catch(\Exception $e)
     {
        return response($e->getMessage(),400);
     }
  }
}
