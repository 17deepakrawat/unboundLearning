<?php

use App\Http\Controllers\Settings\LMS\NotificationController;
use App\Http\Controllers\Settings\LMS\NoteController;
use App\Http\Controllers\Settings\LMS\EbookController;
use App\Http\Controllers\Settings\LMS\IDCardController;
use App\Http\Controllers\Settings\LMS\QuerySubTypeController;
use App\Http\Controllers\Settings\LMS\QueryTypeController;
use App\Http\Controllers\Settings\LMS\VideoController;
use Illuminate\Support\Facades\Route;

//LMS Video Routes
Route::get('settings/lms/videos', [VideoController::class, 'index'])->name('settings.lms.videos');
Route::post('settings/lms/videos', [VideoController::class, 'store'])->name('settings.lms.videos');
Route::get('settings/lms/video/create', [VideoController::class, 'create'])->name('settings.lms.video.create');
Route::get('settings/lms/video/edit/{video_id}', [VideoController::class, 'edit'])->name('settings.lms.video.edit');
Route::get('settings/lms/video/status/{video_id}', [VideoController::class, 'status'])->name('settings.lms.video.status');
Route::put('settings/lms/video/update/{video_id}', [VideoController::class, 'update'])->name('settings.lms.video.update');

//LMS E-Books Routes
Route::get('settings/lms/e-books', [EbookController::class, 'index'])->name('settings.lms.e-books');
Route::post('settings/lms/e-books', [EbookController::class, 'store'])->name('settings.lms.e-books');
Route::get('settings/lms/e-books/create', [EbookController::class, 'create'])->name('settings.lms.e-books.create');
Route::get('settings/lms/e-books/edit/{ebooks_id}', [EbookController::class, 'edit'])->name('settings.lms.e-books.edit');
Route::get('settings/lms/e-books/status/{ebooks_id}', [EbookController::class, 'status'])->name('settings.lms.e-books.status');
Route::put('settings/lms/e-books/update/{ebooks_id}', [EbookController::class, 'update'])->name('settings.lms.e-books.update');

//LMS Notes Routes
Route::get('settings/lms/notes', [NoteController::class, 'index'])->name('settings.lms.notes');
Route::post('settings/lms/notes', [NoteController::class, 'store'])->name('settings.lms.notes');
Route::get('settings/lms/notes/create', [NoteController::class, 'create'])->name('settings.lms.notes.create');
Route::get('settings/lms/notes/edit/{ebooks_id}', [NoteController::class, 'edit'])->name('settings.lms.notes.edit');
Route::get('settings/lms/notes/status/{ebooks_id}', [NoteController::class, 'status'])->name('settings.lms.notes.status');
Route::put('settings/lms/notes/update/{ebooks_id}', [NoteController::class, 'update'])->name('settings.lms.notes.update');

///LMS Query Type
Route::get('settings/lms/query-type', [QueryTypeController::class, 'index'])->name('settings.lms.query-type');
Route::get('settings/lms/query-type/create', [QueryTypeController::class, 'create'])->name('settings.lms.query-type.create');
Route::get('settings/lms/query-type/edit/{id}', [QueryTypeController::class, 'edit'])->name('settings.lms.query-type.edit');
Route::post('settings/lms/query-type', [QueryTypeController::class, 'store'])->name('settings.lms.query-type.store');
Route::put('settings/lms/query-type/update/{id}', [QueryTypeController::class, 'update'])->name('settings.lms.query-type.update');
Route::get('settings/lms/query-type/status/{id}', [QueryTypeController::class, 'status'])->name('settings.lms.query-type.status');

///LMS Query Sub Type
Route::get('settings/lms/query-sub-type', [QuerySubTypeController::class, 'index'])->name('settings.lms.query-sub-type');
Route::get('settings/lms/query-sub-type/create', [QuerySubTypeController::class, 'create'])->name('settings.lms.query-sub-type.create');
Route::get('settings/lms/query-sub-type/edit/{id}', [QuerySubTypeController::class, 'edit'])->name('settings.lms.query-sub-type.edit');
Route::post('settings/lms/query-sub-type', [QuerySubTypeController::class, 'store'])->name('settings.lms.query-sub-type.store');
Route::put('settings/lms/query-sub-type/update/{id}', [QuerySubTypeController::class, 'update'])->name('settings.lms.query-sub-type.update');
Route::get('settings/lms/query-sub-type/status/{id}', [QuerySubTypeController::class, 'status'])->name('settings.lms.query-sub-type.status');

///LMS ID-Card Routes
Route::get('settings/lms/id-card', [IDCardController::class, 'index'])->name('settings.lms.id-card');
Route::post('settings/lms/id-card', [IDCardController::class, 'store'])->name('settings.lms.id-card');
Route::get('settings/lms/id-card/create', [IDCardController::class, 'create'])->name('settings.lms.id-card.create');
Route::get('settings/lms/id-card/edit/{id}', [IDCardController::class, 'edit'])->name('student.id-card.edit');
Route::put('settings/lms/id-card/update/{id}', [IDCardController::class, 'update'])->name('settings.lms.id-card.update');
Route::get('settings/lms/id-card/status/{id}', [IDCardController::class, 'status'])->name('settings.lms.id-card.status');

////LMS Notification Routes
Route::get('settings/lms/notification', [NotificationController::class, 'index'])->name('settings.lms.notification');
Route::post('settings/lms/notification', [NotificationController::class, 'store'])->name('settings.lms.notification');
Route::put('settings/lms/notification/update/{id}', [NotificationController::class, 'update'])->name('settings.lms.notification.update');
Route::get('settings/lms/notification/create', [NotificationController::class, 'create'])->name('settings.lms.notification.create');
Route::get('settings/lms/notification/edit/{id}', [NotificationController::class, 'edit'])->name('settings.lms.notification.edit');
Route::get('settings/lms/notification/status/{id}', [NotificationController::class, 'status'])->name('settings.lms.notification.status');
