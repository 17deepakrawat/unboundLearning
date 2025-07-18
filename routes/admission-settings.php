<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\Admissions\AdmissionSessionController;
use App\Http\Controllers\Settings\Admissions\AdmissionTypeController;
use App\Http\Controllers\Settings\Admissions\EligibilityCriterionController;
use App\Http\Controllers\Settings\Admissions\FeeStructureController;
use App\Http\Controllers\Settings\Admissions\SchemeController;
use App\Http\Controllers\Settings\Admissions\ModeController;
use App\Http\Controllers\Settings\Admissions\PaperTypeController;
use App\Http\Controllers\Settings\Admissions\StudentStatusController;

Route::group(['middleware' => ['auth']], function () {
  // Admission Types
  Route::get('/settings/admissions/admission-types', [AdmissionTypeController::class, 'index'])->name('settings.admissions.admission-types');
  Route::get('/settings/admissions/admission-types/create', [AdmissionTypeController::class, 'create'])->name('settings.admissions.admission-types.create');
  Route::post('/settings/admissions/admission-types', [AdmissionTypeController::class, 'store'])->name('settings.admissions.admission-types');
  Route::get('/settings/admissions/admission-types/edit/{id}', [AdmissionTypeController::class, 'edit'])->name('settings.admissions.admission-types.edit');
  Route::put('/settings/admissions/admission-types/update/{id}', [AdmissionTypeController::class, 'update'])->name('settings.admissions.admission-types.update');
  Route::get('/settings/admissions/admission-types/status/{id}', [AdmissionTypeController::class, 'status']);

  // Fee Structures
  Route::get('/settings/admissions/fee-structures', [FeeStructureController::class, 'index'])->name('settings.admissions.fee-structures');
  Route::get('/settings/admissions/fee-structures/create', [FeeStructureController::class, 'create'])->name('settings.admissions.fee-structures.create');
  Route::post('/settings/admissions/fee-structures', [FeeStructureController::class, 'store'])->name('settings.admissions.fee-structures');
  Route::get('/settings/admissions/fee-structures/edit/{id}', [FeeStructureController::class, 'edit'])->name('settings.admissions.fee-structures.edit');
  Route::put('/settings/admissions/fee-structures/update/{id}', [FeeStructureController::class, 'update'])->name('settings.admissions.fee-structures.update');
  Route::get('/settings/admissions/fee-structures/status/{id}', [FeeStructureController::class, 'status']);

  // Schemes
  Route::get('/settings/admissions/schemes', [SchemeController::class, 'index'])->name('settings.admissions.schemes');
  Route::get('/settings/admissions/schemes/create', [SchemeController::class, 'create'])->name('settings.admissions.schemes.create');
  Route::post('/settings/admissions/schemes', [SchemeController::class, 'store'])->name('settings.admissions.schemes');
  Route::get('/settings/admissions/schemes/status/{id}', [SchemeController::class, 'status']);
  Route::get('/settings/admissions/schemes/edit/{id}', [SchemeController::class, 'edit'])->name('settings.admissions.schemes.edit');
  Route::put('/settings/admissions/schemes/update/{id}', [SchemeController::class, 'update'])->name('settings.admissions.schemes.update');

  //Modes
  Route::get('/settings/admissions/modes', [ModeController::class, 'index'])->name('settings.admissions.modes');
  Route::get('/settings/admissions/create', [ModeController::class, 'create'])->name('settings.admissions.modes.create');
  Route::post('/settings/admissions/modes', [ModeController::class, 'store'])->name('settings.admissions.modes');
  Route::get('/settings/admissions/modes/status/{id}', [ModeController::class, 'status']);
  Route::get('/settings/admissions/mode/edit/{id}', [ModeController::class, 'edit'])->name('settings.admissions.modes.edit');
  Route::put('/settings/admissions/modes/update/{id}', [ModeController::class, 'update'])->name('settings.admissions.modes.update');


  // Admission Sessions
  Route::get('/settings/admissions/admission-sessions', [AdmissionSessionController::class, 'index'])->name('settings.admissions.admission-sessions');
  Route::get('/settings/admissions/admission-sessions/create', [AdmissionSessionController::class, 'create'])->name('settings.admissions.admission-sessions.create');
  Route::post('/settings/admissions/admission-sessions', [AdmissionSessionController::class, 'store'])->name('settings.admissions.admission-sessions');
  Route::get('/settings/admissions/admission-sessions/status/{id}', [AdmissionSessionController::class, 'status']);
  Route::get('/settings/admissions/admission-sessions/current-status/{id}', [AdmissionSessionController::class, 'currentStatus']);
  Route::get('/settings/admissions/admission-sessions/edit/{id}', [AdmissionSessionController::class, 'edit'])->name('settings.admissions.admission-sessions.edit');
  Route::put('/settings/admissions/admission-sessions/update/{id}', [AdmissionSessionController::class, 'update'])->name('settings.admissions.admission-sessions.update');

  // Eligibility Criteria
  Route::get('/settings/admissions/eligibility-criteria', [EligibilityCriterionController::class, 'index'])->name('settings.admissions.eligibility-criteria');
  Route::get('/settings/admissions/eligibility-criteria/create', [EligibilityCriterionController::class, 'create'])->name('settings.admissions.eligibility-criteria.create');
  Route::post('/settings/admissions/eligibility-criteria', [EligibilityCriterionController::class, 'store'])->name('settings.admissions.eligibility-criteria');
  Route::get('/settings/admissions/eligibility-criteria/status/{id}', [EligibilityCriterionController::class, 'status']);
  Route::get('/settings/admissions/eligibility-criteria/edit/{id}', [EligibilityCriterionController::class, 'edit'])->name('settings.admissions.eligibility-criteria.edit');
  Route::delete('/settings/admissions/eligibility-criteria/destroy/{id}', [EligibilityCriterionController::class, 'destroy'])->name('settings.admissions.eligibility-criteria.destroy');
  Route::post('/settings/admissions/eligibility-criteria/update/{id}', [EligibilityCriterionController::class, 'update'])->name('settings.admissions.eligibility-criteria.update');

  //Student status
  Route::get('settings/admissions/student-status',[StudentStatusController::class,'index'])->name('settings.admissions.student-status');
  Route::get('settings/admissions/student-status/status/{id}',[StudentStatusController::class,'status'])->name('settings.admissions.student-status.status');
  Route::get('settings/admissions/student-status/edit/{id}',[StudentStatusController::class,'edit'])->name('settings.admissions.student-status.edit');
  Route::post('/settings/admissions/student-status/update/{id}', [StudentStatusController::class, 'update'])->name('settings.admissions.student-status.update');

  //Paper Type
  Route::get('settings/admissions/paper-types',[PaperTypeController::class,'index'])->name('settings.admissions.paper-types');
  Route::post('settings/admissions/paper-types',[PaperTypeController::class,'store'])->name('settings.admissions.paper-types');
  Route::get('settings/admissions/paper-types/create',[PaperTypeController::class,'create'])->name('settings.admissions.paper-types.create');
  Route::put('settings/admissions/paper-types/update/{id}',[PaperTypeController::class,'update'])->name('settings.admissions.paper-types.update');
  Route::get('settings/admissions/papertype/edit/{id}',[PaperTypeController::class,'edit'])->name('settings.admissions.papertype.edit');
  Route::get('settings/admissions/papertype/delete/{id}',[PaperTypeController::class,'destroy'])->name('settings.admissions.papertype.delete');
  Route::get('settings/admissions/paper-types/status',[PaperTypeController::class,'status'])->name('settings.admissions.paper-types.status');
});
