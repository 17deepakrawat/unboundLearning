<?php

namespace App\Http\Controllers\Academics;

use App\Http\Controllers\Controller;
use App\Models\Academics\ApplicationFields;
use App\Models\Academics\StudentDocument;
use App\Models\Leads\Opportunity;
use App\Models\Leads\OpportunityCustomField;
use App\Models\Settings\Leads\CustomField;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class StudentDocumentController extends Controller
{
  public function setDocumentAsApprove($opportunityId)
  {
    try {
      $documentData['opportunities_id'] = $opportunityId;
      $documentData['status'] = '1';
      // $documentData['added_by'] = Auth::guard('web')->user()->id;
      $documentData['approved_by'] = Auth::guard('web')->user()->id;
      $documentData['pendency'] = null;
      $makeApprovalDocuments = StudentDocument::updateOrCreate(['opportunities_id' => $opportunityId], $documentData);
      return response()->json(['status' => 'success', 'message' => 'Document approved successfull']);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function setDocumentAsPendency($opportunityId)
  {
    $opportunity = Opportunity::where('id', $opportunityId)->first();
    $applicationFields = ApplicationFields::where('vertical_id', $opportunity->vertical_id)->pluck('field_id')->toArray();
    $customFields = CustomField::whereIn('id', $applicationFields)->where('type', 'File')->whereNot('schema', 'avatar')->pluck('name', 'schema')->toArray();
    $studentsAllDocumentData = OpportunityCustomField::where('opportunity_id', $opportunityId)->get(array_keys($customFields));
    $submittedDocuments = [];
    if (!empty($studentsAllDocumentData) && count($studentsAllDocumentData) > 0) {
      foreach ($studentsAllDocumentData[0]->toArray() as $columnName => $documentsArr) {
        $allDocuments = !empty($documentsArr) ? json_decode($documentsArr, true) : [];
        foreach ($allDocuments as $key => $docs) {
          $submittedDocuments[$columnName][$key]['path'] = asset($docs);
          $submittedDocuments[$columnName][$key]['ext'] = pathinfo(asset($docs))['extension'];
        }
      }
    }
    return view('academics.application.pending-document', compact('submittedDocuments', 'opportunityId', 'customFields'));
  }

  public function createPendency(Request $request, $opportunityId)
  {
    try {
      $documentData['opportunities_id'] = $opportunityId;
      $documentData['status'] = '2';
      $documentData['added_by'] = Auth::guard('web')->user()->id;
      //   $documentData['approved_by'] = Auth::guard('web')->user()->id;
      $documentData['pendency'] = json_encode($request->remark, JSON_FORCE_OBJECT);
      StudentDocument::updateOrCreate(['opportunities_id' => $opportunityId], $documentData);
      return response()->json(['status' => 'success', 'message' => 'Pendecy created successfull']);
    } catch (Exception $e) {
      return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
  }

  public function getPendencyDocs($opportunityId)
  {
    $data = StudentDocument::where('opportunities_id', $opportunityId)->get();
    $pendancyData = $data[0]->pendency;
    $opportunity = Opportunity::where('id', $opportunityId)->first();
    $applicationFields = ApplicationFields::where('vertical_id', $opportunity->vertical_id)->pluck('field_id')->toArray();
    $customFields = CustomField::whereIn('id', $applicationFields)->where('type', 'File')->whereNot('schema', 'avatar')->pluck('name', 'schema')->toArray();
    $studentsAllDocumentData = OpportunityCustomField::where('opportunity_id', $opportunityId)->get(array_keys($customFields));
    $submittedDocuments = [];
    if (!empty($studentsAllDocumentData) && count($studentsAllDocumentData) > 0) {
      foreach ($studentsAllDocumentData[0]->toArray() as $columnName => $documentsArr) {
        $allDocuments = !empty($documentsArr) ? json_decode($documentsArr, true) : [];
        foreach ($allDocuments as $key => $docs) {
          $submittedDocuments[$columnName][$key]['path'] = asset($docs);
          $submittedDocuments[$columnName][$key]['ext'] = pathinfo(asset($docs))['extension'];
        }
      }
    }
    return view('academics.application.pending-document', compact('submittedDocuments', 'opportunityId', 'pendancyData', 'customFields'));
  }

  public function reUploadDocument($opportunityId)
  {
    $data = StudentDocument::where('opportunities_id', $opportunityId)->get();
    $pendancyData = !empty($data[0]->pendency) ? json_decode($data[0]->pendency, true) : [];
    $opportunity = Opportunity::where('id', $opportunityId)->first();
    $applicationFields = ApplicationFields::where('vertical_id', $opportunity->vertical_id)->pluck('field_id')->toArray();
    $customFields = CustomField::whereIn('id', $applicationFields)->where('type', 'File')->whereNot('schema', 'avatar')->get(['schema', 'name', 'extension', 'is_multiple']);
    $allCustomFields = [];
    foreach ($customFields as $field) {
      $allowedExtensions = implode(',', json_decode($field->extension));
      $allCustomFields[$field->schema] = [
        'name' => $field->name,
        'is_multiple' => $field->is_multiple,
        'extension' => $allowedExtensions
      ];
    }

    return view('academics.application.reupload-document', compact('opportunityId', 'pendancyData', 'allCustomFields'));
  }

  public function storeReUploadDocument(Request $request, $opportunityId)
  {
    $allKeys = array_keys($request->all());
    // dd($allKeys);
    foreach ($allKeys as $fileKey) {
      if ($request->hasFile($fileKey)) {
        if ($request->hasFile($fileKey)) {
          $path = 'students';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = $path . '/files';
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $path = $path . '/' . $opportunityId;
          if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777);
          }
          $images = array();
          if (is_array($request->file($fileKey))) {
            foreach ($request->file($fileKey) as $key => $image) {
              $newFileName =  $fileKey . '_' . ($key + 1) . '.' . $image->extension();
              $image->move(public_path($path), $newFileName);
              $images[$key] = $path . '/' . $newFileName;
            }
          } else {
            $image = $request->file($fileKey);
            $newFileName = $fileKey . '.' . $image->extension();
            $image->move(public_path($path), $newFileName);
            $images[] = $path . '/' . $newFileName;
          }
          $customFieldsData[$fileKey] = json_encode($images);
        }
      }
    }
    $customFieldsData['opportunity_id'] = $opportunityId;
    $opportunity = OpportunityCustomField::where('opportunity_id', $opportunityId)->first();
    if ($opportunity == null) {
      $customFieldsData['opportunity_id'] = $opportunityId;
      $customFields = OpportunityCustomField::insert($customFieldsData);
    } else {
      $customFields = OpportunityCustomField::where('id', $opportunity->id)->update($customFieldsData);
    }
    if ($customFields) {
      $documentData['opportunities_id'] = $opportunityId;
      $documentData['status'] = '3';
      $documentData['added_by'] = Auth::guard('web')->user()->id;
      //   $documentData['approved_by'] = Auth::guard('web')->user()->id;
      // $documentData['pendency'] = json_encode($request->remark,JSON_FORCE_OBJECT);
      StudentDocument::updateOrCreate(['opportunities_id' => $opportunityId], $documentData);
      return response()->json(['status' => 'success', 'message' => 'Pendecy created successfull']);
    } else {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
    }
  }
}
