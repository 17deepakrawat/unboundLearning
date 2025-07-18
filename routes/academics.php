<?php

use App\Http\Controllers\Academics\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Academics\VerticalController;
use App\Http\Controllers\Academics\DepartmentController;
use App\Http\Controllers\Academics\ProgramController;
use App\Http\Controllers\Academics\ProgramTypeController;
use App\Http\Controllers\Academics\SpecializationController;
use App\Http\Controllers\Academics\ApplicationFormController;
use App\Http\Controllers\Academics\EventController;
use App\Http\Controllers\Academics\StudentDocumentController;
use App\Http\Controllers\Academics\SyllabusController;
use App\Http\Controllers\Leads\OpportunityController;
use App\Http\Controllers\VerticalTestimonialController;

Route::group(['middleware' => ['auth']], function () {

  Route::get('/academics/verticals', [VerticalController::class, 'index'])->name('academics.verticals');
  Route::get('/academics/verticals/create', [VerticalController::class, 'create'])->name('academics.verticals.create');
  Route::post('/academics/verticals', [VerticalController::class, 'store'])->name('academics.verticals');
  Route::get('/academics/verticals/edit/{id}', [VerticalController::class, 'edit'])->name('academics.verticals.edit');
  Route::put('/academics/verticals/update/{id}', [VerticalController::class, 'update'])->name('academics.verticals.update');
  Route::get('/academics/verticals/configurations/{id}', [VerticalController::class, 'configurations'])->name('academics.verticals.configurations');
  Route::put('/academics/verticals/configurations/update/{id}', [VerticalController::class, 'updateConfigurations'])->name('academics.verticals.configurations.update');
  Route::get('/academics/verticals/content/{id}', [VerticalController::class, 'content'])->name('academics.verticals.content');
  Route::post('/academics/verticals/content/store', [VerticalController::class, 'contentStore'])->name('academics.verticals.content.store');

  // Vertical Testimonials
   // Career Testimonials Routess
   Route::get('/website/content/vertical/testimonial/{id}',[VerticalTestimonialController::class,'index'])->name('website.content.vertical.testimonial');
   Route::get('/website/content/vertical/testimonial/create/{id}',[VerticalTestimonialController::class,'create'])->name('website.content.vertical.testimonial.create');
   Route::post('/website/content/vertical/testimonial/store',[VerticalTestimonialController::class,'store'])->name('website.content.vertical.testimonial.store');
   Route::get('/website/content/vertical/testimonial/edit/{id}',[VerticalTestimonialController::class,'edit'])->name('website.content.vertical.testimonial.edit');
   Route::put('/website/content/vertical/testimonial/update/{id}',[VerticalTestimonialController::class,'update'])->name('website.content.vertical.testimonial.update');
   Route::get('/website/content/vertical/testimonial/delete/{id}',[VerticalTestimonialController::class,'delete'])->name('website.content.vertical.testimonial.delete');
  //Departments
  Route::get('/academics/departments', [DepartmentController::class, 'index'])->name('academics.departments');
  Route::get('/academics/departments/create', [DepartmentController::class, 'create'])->name('academics.departments.create');
  Route::post('/academics/departments', [DepartmentController::class, 'store'])->name('academics.departments');
  Route::get('/academics/departments/status/{id}', [DepartmentController::class, 'status']);
  Route::get('/academics/departments/create/assign-verticals/{id}', [DepartmentController::class, 'createVerticals'])->name('academics.departments.create.assign-verticals');
  Route::post('/academics/departments/assign-verticals', [DepartmentController::class, 'storeVerticals'])->name('academics.departments.assign-verticals');
  Route::get('/academics/departments/edit/{id}', [DepartmentController::class, 'edit'])->name('academics.departments.edit');
  Route::put('/academics/departments/update/{id}', [DepartmentController::class, 'update'])->name('academics.departments.update');
  Route::get('/academics/departments/content/{id}', [DepartmentController::class, 'content'])->name('academics.departments.content');
  Route::post('/academics/departments/content/store', [DepartmentController::class, 'contentStore'])->name('academics.departments.content.store');

  // Course Types
  Route::get('/academics/program-types', [ProgramTypeController::class, 'index'])->name('academics.program-types');
  Route::get('/academics/program-types/create', [ProgramTypeController::class, 'create'])->name('academics.program-types.create');
  Route::post('/academics/program-types', [ProgramTypeController::class, 'store'])->name('academics.program-types');
  Route::get('/academics/program-types/status/{id}', [ProgramTypeController::class, 'status']);
  Route::get('/academics/program-types/create/assign-department-vertical/{id}', [ProgramTypeController::class, 'createDepartmentVerticals'])->name('academics.program-types.create.assign-department-vertical');
  Route::post('/academics/program-types/assign-department-vertical', [ProgramTypeController::class, 'assignDepartmentVerticals'])->name('academics.program-types.assign-department-vertical');
  Route::get('/academics/program-types/edit/{id}', [ProgramTypeController::class, 'edit'])->name('academics.program-types.edit');
  Route::put('/academics/program-types/update/{id}', [ProgramTypeController::class, 'update'])->name('academics.program-types.update');
  Route::get('/academics/program-types/content/{id}', [ProgramTypeController::class, 'content'])->name('academics.program-types.content');
  Route::post('/academics/program-types/content/store', [ProgramTypeController::class, 'contentStore'])->name('academics.program-types.content.store');

  // Programs
  Route::get('/academics/programs', [ProgramController::class, 'index'])->name('academics.programs');
  Route::get('/academics/programs/create', [ProgramController::class, 'create'])->name('academics.programs.create');
  Route::post('/academics/programs', [ProgramController::class, 'store'])->name('academics.programs');
  Route::get('/academics/programs/edit/{id}', [ProgramController::class, 'edit'])->name('academics.programs.edit');
  Route::put('/academics/programs/update/{id}', [ProgramController::class, 'update'])->name('academics.programs.update');
  Route::get('/academics/programs/status/{id}', [ProgramController::class, 'status']);
  Route::get('/academics/programs/create/assign-program-type-department-vertical/{id}', [ProgramController::class, 'createProgramTypeDepartmentVerticals'])->name('academics.programs.create.assign-program-type-department-vertical');
  Route::post('/academics/programs/assign-program-type-department-vertical', [ProgramController::class, 'assignProgramTypeDepartmentVerticals'])->name('academics.programs.assign-program-type-department-vertical');
  Route::get('/academics/programs/content/{id}', [ProgramController::class, 'content'])->name('academics.programs.content');
  Route::post('/academics/programs/content/store', [ProgramController::class, 'contentStore'])->name('academics.programs.content.store');

  // Specializations
  Route::get('/academics/specializations', [SpecializationController::class, 'index'])->name('academics.specializations');
  Route::get('/academics/specializations/create', [SpecializationController::class, 'create'])->name('academics.specializations.create');
  Route::post('/academics/specializations', [SpecializationController::class, 'store'])->name('academics.specializations');
  Route::get('/academics/specializations/edit/{id}', [SpecializationController::class, 'edit'])->name('academics.specializations.edit');
  Route::put('/academics/specializations/update/{id}', [SpecializationController::class, 'update'])->name('academics.specializations.update');
  Route::get('/academics/specializations/status/{id}', [SpecializationController::class, 'status']);
  Route::get('/academics/specializations/content/{id}', [SpecializationController::class, 'content'])->name('academics.specializations.content');
  Route::get('/academics/specializations/skill/content/{id}', [SpecializationController::class, 'skilContent'])->name('academics.specializations.skill.content');
  Route::post('/academics/specializations/content/store', [SpecializationController::class, 'contentStore'])->name('academics.specializations.content.store');
  Route::post('/academics/specializations/skill/content/store', [SpecializationController::class, 'contentStore'])->name('academics.specializations.skill.content.store');
  Route::get('/academics/specializations/assign-vertical/{id}', [SpecializationController::class, 'assignVertical']);
  Route::post('/academics/specializations/assign-vertical/store', [SpecializationController::class, 'assignVerticalStore'])->name('academics.specializations.assign-vertical.store');
  Route::post('/academics/specializations/assign-vertical/configure', [SpecializationController::class, 'configureVertical'])->name('academics.specializations.assign-vertical.configure');
  Route::post('/academics/specializations/assign-vertical/configure/store', [SpecializationController::class, 'configureStore'])->name('academics.specializations.assign-vertical.configure.store');

  //Form Design
  Route::get('/academics/verticals/form-designer/{vertical_id}', [ApplicationFormController::class, 'generateApplicationForm'])->name('academics.verticals.form-designer');
  Route::get('/academics/verticals/form-designer/steps/{vertical_id}', [ApplicationFormController::class, 'applicationFormSteps'])->name('academics.verticals.form-designer.steps');
  Route::get('/academics/verticals/form-designer/custom-fields/{vertical_id}', [ApplicationFormController::class, 'customFields'])->name('academics.verticals.form-designer.custom-fields');
  Route::get('/academics/vertical/application/step/create/{vertical_id}', [ApplicationFormController::class, 'createStep'])->name('academics.verticals.application.step.create');
  Route::get('/academics/vertical/application/rules/view/{vertical_id}', [ApplicationFormController::class, 'applicationFormRules'])->name('academics.verticals.application.rules.view');
  Route::get('/academics/vertical/application/rules/create/{vertical_id}', [ApplicationFormController::class, 'createRule'])->name('academics.verticals.application.rules.create');
  Route::get('/academics/vertical/application/rules/getValueDom/{vertical_id}', [ApplicationFormController::class, 'getValueDom'])->name('academics.verticals.application.rules.getValueDom');
  Route::get('/academics/vertical/application/rules/condition-operators/{vertical_id}', [ApplicationFormController::class, 'conditionOperators'])->name('academics.verticals.application.rules.conditionOperators');
  Route::get('/academics/vertical/application/rules/fields/{vertical_id}', [ApplicationFormController::class, 'getFields'])->name('academics.verticals.application.rules.fields');
  Route::post('/academics/vertical/application/rules/store', [ApplicationFormController::class, 'storeRule'])->name('academics.verticals.application.rules.store');
  Route::post('/academics/verticals/application/step/store', [ApplicationFormController::class, 'storeStep'])->name('academics.verticals.application.step.store');
  Route::get('/academics/vertical/application/step/edit/{id}', [ApplicationFormController::class, 'editStep'])->name('academics.verticals.application.step.edit');
  Route::delete('/academics/vertical/application/step/delete/{id}', [ApplicationFormController::class, 'deleteStep'])->name('academics.verticals.application.step.delete');
  Route::post('/academics/vertical/application/step/postion/update', [ApplicationFormController::class, 'updateStepPosition'])->name('academics.verticals.application.step.position.udate');
  Route::post('/academics/vartical/application/application-fields', [ApplicationFormController::class, 'storeFields'])->name('academics.vartical.application.application-fields.store');
  Route::post('/academics/vartical/application/application-fields/remove', [ApplicationFormController::class, 'removeField'])->name('academics.vartical.application.application-fields.remove');

  //Student Application
  Route::get('manage/students/applications',[ApplicationController::class,'index'])->name('manage.students.applications');
  Route::get('manage/students/applications/create/{opportunity_id}', [ApplicationController::class, 'create'])->name('manage.students.applications.create');
  Route::post('/manage/students/applications/store', [ApplicationController::class, 'store'])->name('manage.students.applications.store');
  Route::get('manage/students/application/admissionType/{sessionid}',[ApplicationController::class,'getAdmissionTypeOnSession']);
  Route::get('manage/students/application/program/{program_type_id}',[ApplicationController::class,'getProramsOnProgramType']);
  Route::get('manage/students/application/specialization/{sub_cource_id}',[ApplicationController::class,'getSpecializationOnProgrm']);
  Route::post('/manage/students/application/admission-durations', [ApplicationController::class, 'getAdmissionDuration']);
  Route::get('manage/student/application/selectvertical',[ApplicationController::class,'setVerticalForApplication'])->name('manage.student.application.selectvertical');
  Route::post('manage/student/application/store',[ApplicationController::class,'store']);
  Route::post('manage/student/application/update/{id}',[ApplicationController::class,'update']);
  Route::get('manage/students/applications/edit/{id}',[ApplicationController::class,'edit']);
  Route::get('manage/students/application/document/review/{opportunity_id}',[ApplicationController::class,'getStudentsDocuments'])->name('manage.students.application.document.review');
  Route::get('manage/students/application/document/approve/{opportunity_id}',[StudentDocumentController::class,'setDocumentAsApprove'])->name('manage.students.application.document.approve');
  Route::get('manage/students/application/document/markpendency/{opportunity_id}',[StudentDocumentController::class,'setDocumentAsPendency'])->name('manage.students.application.document.markpendency');
  Route::post('manage/students/application/document/pendency/create/{opportunity_id}',[StudentDocumentController::class,'createPendency'])->name('manage.students.application.document.pendency.create');
  Route::get('manage/students/application/document/pending/{opportunity_id}',[StudentDocumentController::class,'getPendencyDocs'])->name('manage.students.application.document.pending');
  Route::get('manage/students/application/document/re-upload/{opportunity_id}',[StudentDocumentController::class,'reUploadDocument'])->name('manage.students.application.document.re-upload');
  Route::put('manage/students/application/document/re-upload/store/{opportunity_id}',[StudentDocumentController::class,'storeReUploadDocument'])->name('manage.students.application.document.re-upload.store');
  Route::get('/manage/application/export', [ApplicationController::class, 'export'])->name('manage.application.export');
  Route::get('manage/opportunity/application-form-pdf/{opportunity_id}',[ApplicationFormController::class,'printApplicationForm'])->name('application-form-pdf');
  //Syllabus and Subjects
  Route::get('academics/syllabus',[SyllabusController::class,'index'])->name('academics.syllabus');
  Route::post('academics/syllabus',[SyllabusController::class,'store'])->name('academics.syllabus');
  Route::get('academics/syllabus/create',[SyllabusController::class,'create'])->name('academics.syllabus.create');
  Route::get('academics/syllabus/edit/{id}',[SyllabusController::class,'edit'])->name('academics.syllabus.edit');
  Route::put('academics/syllabus/update/{id}',[SyllabusController::class,'update'])->name('academics.syllabus.update');
  Route::get('academics/syllabus/status/{id}',[SyllabusController::class,'status'])->name('academics.syllabus.status');
  Route::get('academics/syllabus/configuration/{id}',[SyllabusController::class,'makeSyllabusConfiguration'])->name('academics.syllabus.configuration');
  Route::post('academics/syllabus/configuration/store',[SyllabusController::class,'syllabusConfigurationStore'])->name('academics.syllabus.configuration.store');
  Route::post('academics/syllabus/configuration/update/{id}',[SyllabusController::class,'syllabusConfigurationUpdate'])->name('academics.syllabus.configuration.update');
  Route::get('academics/syllabus/configuration/add-chapter/{query_type}/{chapter_count}/{chapterId}',[SyllabusController::class,'addChapter'])->name('academics.syllabus.configuration.addchapter');
  Route::get('academics/syllabus/configuration/add-unit/{query_type}/{unit_count}/{chapter_id}/{unitId}',[SyllabusController::class,'addUnit'])->name('academics.syllabus.configuration.addunit');
  Route::get('academics/syllabus/configuration/add-topic/{query_type}/{topic_id}/{unit_count}/{chapter_id}/{topicId}',[SyllabusController::class,'addTopic'])->name('academics.syllabus.configuration.addtopic');
  Route::get('academics/syllabus/delete/{type}/{id}',[SyllabusController::class,'deleteSyllabus'])->name('academics.syllabus.delete');

  // Events Categories
  Route::get('/academics/events/categories', [EventController::class, 'getAllCategories'])->name('academics.events.categories');
  Route::get('/academics/events/categories/create', [EventController::class, 'createEventCategory'])->name('academics.events.categories.create');
  Route::post('/academics/events/categories/store', [EventController::class, 'storeEventCategory'])->name('academics.events.categories.store');
  Route::get('/academics/events/categories/edit/{id}', [EventController::class, 'editEventCategory'])->name('academics.events.categories.edit');
  Route::put('/academics/events/categories/update/{id}', [EventController::class, 'updateEventCategory'])->name('academics.events.categories.update');
  Route::delete('/academics/events/categories/delete/{id}', [EventController::class, 'deleteEventCategory'])->name('academics.events.categories.delete');

  // Events
  Route::get('/academics/events', [EventController::class, 'index'])->name('academics.events');
  Route::get('/academics/events/fetch', [EventController::class, 'fetchEvents'])->name('academics.events.fetch');
  Route::get('/academics/events/create', [EventController::class, 'createEvent'])->name('academics.events.create');
  Route::post('/academics/events/store', [EventController::class, 'storeEvent'])->name('academics.events.store');
  Route::get('/academics/events/edit/{id}', [EventController::class, 'editEvent'])->name('academics.events.edit');
  Route::put('/academics/events/update/{id}', [EventController::class, 'updateEvent'])->name('academics.events.update');
  Route::delete('/academics/events/delete/{id}', [EventController::class, 'deleteEvent'])->name('academics.events.delete');
});
