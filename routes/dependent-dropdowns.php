<?php

use App\Http\Controllers\Academics\DepartmentController;
use App\Http\Controllers\Academics\ProgramController;
use App\Http\Controllers\Academics\SpecializationController;
use App\Http\Controllers\Academics\SyllabusController;
use App\Http\Controllers\Settings\Admissions\AdmissionSessionController;
use App\Http\Controllers\Settings\Admissions\AdmissionTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\Admissions\FeeStructureController;
use App\Http\Controllers\Settings\Admissions\SchemeController;
use App\Http\Controllers\Leads\LeadController;
use App\Http\Controllers\Settings\Leads\CustomFieldController;
use App\Http\Controllers\Settings\Leads\SubSourceController;
use App\Http\Controllers\User\UserController;

Route::group(['middleware' => ['auth']], function () {
  Route::get('/settings/dropdowns/fee-structures-by-vertical/{vertical_id}', [FeeStructureController::class, 'feeStructureByVertical']);
  Route::get('/settings/dropdowns/admission-types-by-vertical/{vertical_id}', [AdmissionTypeController::class, 'admissionTypesByVertical']);
  Route::get('/settings/dropdowns/schemes-by-vertical/{vertical_id}', [SchemeController::class, 'schemesByVertical']);
  Route::get('/settings/dropdowns/admission-sessions-by-vertical/{vertical_id}', [AdmissionSessionController::class, 'admissionSessionsByVertical']);
  Route::get('/settings/dropdowns/programs-by-department/{department_id}', [DepartmentController::class, 'programsByDepartment']);
  Route::get('/settings/dropdowns/department-by-vertical/{vertical_id}', [DepartmentController::class, 'departmentByVertical']);
  Route::get('/settings/dropdowns/program-types-by-program/{program_id}', [ProgramController::class, 'programTypesByProgram']);
  Route::get('/settings/dropdowns/programs-by-vertical/{vertical_id}', [ProgramController::class, 'programsByVertical']);
  Route::get('/settings/dropdowns/schemes-by-admission-session/{admission_session_id}', [AdmissionSessionController::class, 'schemesByAdmissionSession']);
  Route::get('/settings/dropdowns/fee-structures-by-scheme/{scheme_id}', [SchemeController::class, 'feeStructuresByScheme']);
  Route::post('/settings/dropdowns/specializations-by-admission-type-session-vertical-user', [SpecializationController::class, 'specializationsByAdmissionTypeSessionVerticalUser']);
  Route::get('/settings/dropdowns/custom-fields/dependent-dropdown/{parentValue}/{childId}', [CustomFieldController::class, 'dependentFiledValues']);
  Route::get('/manager/custom-field/dependent/options/{schema}/{value}/{leadid}', [LeadController::class, 'customOptions'])->name('manager.custom-field.dependent.options');

  Route::get('/manage/lead/substage/{id}', [LeadController::class, 'getSubStages'])->name('manage.lead.substage');
  Route::get('/settings/dropdowns/sub-source-by-source/{source_id}', [SubSourceController::class, 'getSubSourceBySource']);

  Route::get('settings/dropdowns/syllabus-by-scheme/{scheme_id}',[SyllabusController::class,'getSyllabusByScheme']);
  Route::get('/users/by-vertical/{id}', [UserController::class, 'getUsersByVertical']);
  Route::get('/verticals/by-user/{id}', [UserController::class, 'getVerticalsByUser']);
  Route::get('/users/downlines/{id}', [UserController::class, 'getUserDownlines']);
  Route::get('syllabus/dropdown/specialization-by-vertical/{vertical_id}',[SyllabusController::class,'getSpecializationByVertical']);
  Route::get('syllabus/dropdown/scheme-by-specialization-and-vertical/{specialization_id}/{vertical_id}',[SyllabusController::class,'getSchemeBySpecializationAndVertical']);
  Route::get('syllabus/dropdown/duration-by-specialization/{specialization_id}',[SyllabusController::class,'getDurationBySpecialization']);
  Route::get('syllabus/dropdown/papertype-by-vertical/{vertical_id}',[SyllabusController::class,'getPaperTypeByVertical']);
  Route::get('settings/video/dropdown/specialization-by-vertical/{vertical_id}',[SyllabusController::class,'getSpecializationByVertical']);
  Route::get('settings/video/dropdown/scheme-by-specialization/{specialization_id}', [SyllabusController::class, 'getSchemeBySpecialization']);
  Route::get('setting/dropdown/chapters-by-syllabus/{syllabusId}',[SyllabusController::class,'getChapterBySyllabus']);
  Route::get('setting/dropdown/unit-by-chapter/{chapterId}',[SyllabusController::class,'getUnitByChapter']);
  Route::get('setting/dropdown/topic-by-unit/{UnitId}/{chapterId}', [SyllabusController::class, 'getTopicByUnit']);
  Route::get('/settings/dropdowns/specializations-by-vertical-and-program/{vertical_id}/{program_id}', [SpecializationController::class, 'specializationsByVerticalAndProgram']);
  Route::get('/settings/dropdowns/specializations-by-program/{program_id}', [SpecializationController::class, 'specializationsByProgram']);
  Route::get('/manage/leads/program', [LeadController::class, 'program'])->name('manage.leads.program');
});
