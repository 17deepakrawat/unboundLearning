<?php

namespace App\Http\Controllers\Panel\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\Models\Academics\ApplicationFields;
use App\Models\Leads\Lead;
use App\Models\Leads\Opportunity;
use App\Models\Leads\OpportunityCustomField;
use App\Models\Settings\Leads\CustomField;
use App\Models\Settings\LMS\IDCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
  public function index()
  {
    $opportunity = Opportunity::where('lead_id', Auth::guard('student')->user()->id)->where('specialization_id', session()->get('specialization_id'))->with('admissionSession', 'specialization', 'vertical', 'admissionType', 'studentStatus')->where('conversion_date', '!=', null)->first();
    $submittedDocuments = [];
    if ($opportunity) {
      $applicationFields = ApplicationFields::where('vertical_id', $opportunity->vertical_id)->pluck('field_id')->toArray();
      $allCustomFields = CustomField::whereIn('id', $applicationFields)->where('type', 'File')->whereNot('schema', 'avatar')->pluck('schema')->toArray();
      if (!empty($allCustomFields)) {
        $studentsAllDocumentData = OpportunityCustomField::where('opportunity_id', $opportunity->id)->get($allCustomFields);
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
    }

    return view('panel.dashboards.student.profile', compact('opportunity', 'submittedDocuments'));
  }

  public function getIdCard()
  {
    $lead_id = Auth::guard('student')->user();
    $opportunityData = Opportunity::where('lead_id', $lead_id->id)->get();
    $customFields = OpportunityCustomField::where('opportunity_id', $opportunityData[0]->id)->get();
    $wholeStudentData = json_encode(array_merge($opportunityData[0]->toArray(), $customFields[0]->toArray(), $lead_id->toArray()));
    $idCardTemplate = IDCard::where('vertical_id', $opportunityData[0]->vertical_id)->where('is_active', 1)->get()->toArray();
    return view('panel.dashboards.student.id-card', compact('idCardTemplate', 'wholeStudentData'));
  }
}
