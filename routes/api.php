<?php

use App\Http\Controllers\Leads\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lead',[LeadController::class,'getAllLeads'])->name('lead');