<?php

use App\Http\Controllers\Settings\Components\LanguageController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
  Route::get('/settings/components/languages', [LanguageController::class, 'index'])->name('settings.components.languages');
  Route::get('/settings/components/languages/create', [LanguageController::class, 'create'])->name('settings.components.languages.create');
  Route::post('/settings/components/languages', [LanguageController::class, 'store'])->name('settings.components.languages');
});
