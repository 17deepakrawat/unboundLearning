<?php

use App\Http\Controllers\Academics\SyllabusController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Panel\Dashboard\LMSController;
use App\Http\Controllers\Panel\Dashboard\Student\StudentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Settings\LMS\NotificationController;
use App\Http\Controllers\Settings\LMS\VideoController;
use App\Http\Controllers\Student\StudentQueryController;
use Illuminate\Support\Facades\Route;


//student LMS
Route::middleware(['auth:student'])->group(function () {
  Route::get('/student/lms', [LMSController::class, 'studentLMS'])->name('student.lms');
  Route::get('/student/lms/notes/{syllabus_id}', [LMSController::class, 'getStudentNotes'])->name('student.lms.notes');
  Route::get('/student/lms/ebooks/{syllabus_id}', [LMSController::class, 'getStudentEBooks'])->name('student.lms.ebooks');
  Route::get('/student/lms/videos/{syllabus_id}', [LMSController::class, 'getStudentEBooksVideo'])->name('student.lms.videos');
  Route::get('/student/lms/ebook/link/{ebook_id}', [LMSController::class, 'getEBook'])->name('student.lms.ebook.link');
  Route::get('/student/lms/note/link/{note_id}', [LMSController::class, 'getNote'])->name('student.lms.note.link');
  Route::get('/student/lms/video/link/{note_id}', [LMSController::class, 'getVideo'])->name('student.lms.video.link');
  Route::get('/student/lms/set-specialization-in-session/{specialization_id}', [LMSController::class, 'setSession'])->name('student.lms.setspecialization');

  //Students Profile
  Route::get('student/profile', [StudentController::class, 'index'])->name('student.profile');
  Route::get('student/id-card', [StudentController::class, 'getIdCard'])->name('student.id-card');
  Route::get('student/question/create/{sourceId}', [QuestionController::class, 'createQuestion'])->name('student.question.create');
  Route::post('student/question/store', [QuestionController::class, 'storeQuestion'])->name('student.question.store');
  Route::post('student/answer/store', [AnswerController::class, 'store'])->name('student.answer.store');

  //Student Query
  Route::get('student/query', [StudentQueryController::class, 'index'])->name('student.lms.submit-a-query');
  Route::get('student/query/create', [StudentQueryController::class, 'create'])->name('student.lms.submit-a-query.create');
  Route::get('student/query/edit/{id}', [StudentQueryController::class, 'edit'])->name('student.lms.submit-a-query.edit');
  Route::get('student/query/view/{id}', [StudentQueryController::class, 'edit'])->name('student.lms.submit-a-query.edit');
  Route::post('student/query', [StudentQueryController::class, 'store'])->name('student.lms.submit-a-query.store');
  Route::put('student/query/update/{id}', [StudentQueryController::class, 'update'])->name('student.lms.submit-a-query.update');
  Route::get('student/query/query-sub-type-by-query-type/{id}', [StudentQueryController::class, 'getQuerySubTypeByQueryType'])->name('student.lms.submit-a-query.subtype-by-query-type');

  ///Student My Syllabus
  Route::get('student/syllabus',[SyllabusController::class,'getStudentSyllabus'])->name('student.syllabus');

  // Student Notification
  Route::get('/student/notification',[NotificationController::class,'getStudentNotification'])->name('student.notification');
  Route::get('/student/notification/view/{id}',[NotificationController::class,'viewNotification'])->name('student.notification.view');
});
