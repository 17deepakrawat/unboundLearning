<?php

use App\Http\Controllers\Academics\ApplicationController;
use App\Http\Controllers\Leads\LeadController;
use App\Http\Controllers\Settings\Leads\ActivitiesController;
use App\Http\Controllers\Settings\Leads\AssignmentRulesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\Leads\SourceController;
use App\Http\Controllers\Settings\Leads\SubSourceController;
use App\Http\Controllers\Settings\Leads\StageController;
use App\Http\Controllers\Settings\Leads\SubStageController;
use App\Http\Controllers\Settings\Leads\CustomFieldController;

Route::group(['middleware' => ['auth']], function () {
  Route::get('/settings/leads/sources', [SourceController::class, 'index'])->name('settings.leads.sources');
  Route::get('/settings/leads/sources/create', [SourceController::class, 'create'])->name('settings.leads.sources.create');
  Route::post('/settings/leads/sources', [SourceController::class, 'store'])->name('settings.leads.sources');
  Route::get('/settings/leads/sources/status/{id}', [SourceController::class, 'status']);

  Route::get('/settings/leads/sub-sources', [SubSourceController::class, 'index'])->name('settings.leads.sub-sources');
  Route::get('/settings/leads/sub-sources/create', [SubSourceController::class, 'create'])->name('settings.leads.sub-sources.create');
  Route::post('/settings/leads/sub-sources', [SubSourceController::class, 'store'])->name('settings.leads.sub-sources');
  Route::get('/settings/leads/sub-sources/status/{id}', [SubSourceController::class, 'status']);

  Route::get('/settings/leads/stages', [StageController::class, 'index'])->name('settings.leads.stages');
  Route::get('/settings/leads/stages/create', [StageController::class, 'create'])->name('settings.leads.stages.create');
  Route::post('/settings/leads/stages', [StageController::class, 'store'])->name('settings.leads.stages');
  Route::get('/settings/leads/stages/status/{id}', [StageController::class, 'status']);
  Route::get('/settings/leads/stages/initial-status/{id}', [StageController::class, 'initialStatus']);
  Route::get('/settings/leads/stages/final-status/{id}', [StageController::class, 'finalStatus']);

  Route::get('/settings/leads/sub-stages', [SubStageController::class, 'index'])->name('settings.leads.sub-stages');
  Route::get('/settings/leads/sub-stages/create', [SubStageController::class, 'create'])->name('settings.leads.sub-stages.create');
  Route::post('/settings/leads/sub-stages', [SubStageController::class, 'store'])->name('settings.leads.sub-stages');
  Route::get('/settings/leads/sub-stages/status/{id}', [SubStageController::class, 'status']);

  //Custom Fields
  Route::get('settings/leads/custom-fields',[CustomFieldController::class,'index'])->name('settings.leads.custom-fields');
  Route::post('settings/leads/custom-fields',[CustomFieldController::class,'store'])->name('settings.leads.custom-fields');
  Route::get('settings/leads/custom-fields/create/{use_for}',[CustomFieldController::class,'create'])->name('settings.leads.custom-fields.create');
  Route::get('settings/leads/custom-fields/edit/{id}',[CustomFieldController::class,'edit'])->name('settings.leads.custom-fields.edit');
  Route::get('settings/leads/custom-fields/status/{id}',[CustomFieldController::class,'status'])->name('settings.leads.custom-field.status');
  Route::get('/setting/custom-fields/dependentoption/{id}/{fieldid}',[CustomFieldController::class,'getDependentOptions'])->name('setting.custom-fields.dependentoption');
  Route::put('settings/leads/custom-fields/update/{id}',[CustomFieldController::class,'update'])->name('settings.admissions.custom-fields.update');

  // Assignment Rules
  Route::get('settings/leads/assignment-rules', [AssignmentRulesController::class, 'index'])->name('settings.leads.assignment-rules');
  Route::post('settings/leads/assignment-rules', [AssignmentRulesController::class, 'store'])->name('settings.leads.assignment-rules');
  Route::get('settings/leads/assignment-rules/create', [AssignmentRulesController::class, 'create'])->name('settings.leads.assignment-rules.create');
  Route::get('settings/leads/assignment-rules/edit/{id}', [AssignmentRulesController::class, 'edit'])->name('settings.leads.assignment-rules.edit');
  Route::post('settings/leads/assignment-rules/update/{id}', [AssignmentRulesController::class, 'update'])->name('settings.leads.assignment-rules.update');
  Route::get('settings/leads/assignment-rules/status/{id}', [AssignmentRulesController::class, 'status'])->name('settings.leads.assignment-rules.status');
  Route::get('settings/leads/assignmets/filter',[AssignmentRulesController::class,'addFilter'])->name('settings.leads.assignmets.filter');
  Route::get('settings/application/assignmets/filter',[AssignmentRulesController::class,'addFilterForApplication'])->name('settings.leads.assignmets.filter');
  Route::get('/settings/leads/assignments/field/value/{id}',[AssignmentRulesController::class,'fieldValue'])->name('settings.leads.assignments.field.value');
  
  // Activities
  Route::get('settings/leads/activities', [ActivitiesController::class, 'index'])->name('settings.leads.activities');
  Route::post('settings/leads/activities', [ActivitiesController::class, 'store'])->name('settings.leads.activities');
  Route::get('settings/leads/activities/create', [ActivitiesController::class, 'create'])->name('settings.leads.activities.create');
  Route::get('settings/leads/activities/edit/{id}', [ActivitiesController::class, 'edit'])->name('settings.leads.activities.edit');
  Route::put('settings/leads/activities/update/{id}', [ActivitiesController::class, 'update'])->name('settings.leads.activities.update');
  Route::get('settings/leads/activities/status/{id}', [ActivitiesController::class, 'status'])->name('settings.leads.activities.status');

  //Leads Filter
  Route::get('settings/leads/filter',[LeadController::class,'addFilterFileds'])->name('settings.leads.filter');
  Route::get('settings/application/filter',[ApplicationController::class,'addFilterFileds'])->name('settings.application.filter');
  Route::get('manage/lead/filter/reset',[LeadController::class,'resetFilter'])->name('manage.lead.filter.reset');
  Route::get('manage/application/filter/reset',[ApplicationController::class,'resetFilter'])->name('manage.application.filter.reset');
});
