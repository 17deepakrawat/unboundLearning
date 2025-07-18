<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\User\RoleController;
use App\Http\Controllers\User\UserController;

Route::group(['middleware' => ['auth']], function () {
  // Roles & Permissions
  Route::get('/users/permissions', [PermissionController::class, 'index'])->name('users.permissions');
  Route::get('/users/permissions/create', [PermissionController::class, 'create'])->name('users.permissions.create');
  Route::post('/users/permissions', [PermissionController::class, 'store'])->name('users.permissions');

  // Roles
  Route::get('/users/roles', [RoleController::class, 'index'])->name('users.roles');
  Route::get('/users/roles/create', [RoleController::class, 'create'])->name('users.roles.create');
  Route::post('/users/roles', [RoleController::class, 'store'])->name('users.roles');
  Route::get('/users/roles/edit/{id}', [RoleController::class, 'edit'])->name('users.roles.edit');
  Route::post('/users/roles/update', [RoleController::class, 'update'])->name('users.roles.update');

  // Users
  Route::get('/users', [UserController::class, 'index'])->name('users');
  Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
  Route::post('/users', [UserController::class, 'store'])->name('users');
  Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
  Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
  Route::get('/users/assign-verticals/{id}', [UserController::class, 'assignVerticals'])->name('users.assign-verticals');
  Route::get('/users/assign-verticals/{id}/sessions/{vertical_id}', [UserController::class, 'assignedSessions'])->name('users.assigned-sessions');
  Route::get('/users/assign-verticals/{id}/sessions/{vertical_id}/create', [UserController::class, 'assignSession'])->name('users.assign-sessions.create');
  Route::post('/users/assign-verticals/sessions/store', [UserController::class, 'assignSessionStore'])->name('users.assign-sessions.store');
  Route::get('/users/assign-verticals/sessions/edit/{id}', [UserController::class, 'editAssignSession'])->name('users.assign-sessions.edit');
  Route::get('/users/reporting/{id}', [UserController::class, 'reporting'])->name('users.reporting');
  Route::post('/users/reporting/store', [UserController::class, 'reportingStore'])->name('users.reporting.store');
  Route::get('/users/change-password/{id}', [UserController::class, 'changePasswordCreate'])->name('users.change-password.create');
  Route::post('/users/change-password/{id}', [UserController::class, 'changePassword'])->name('users.change-password.update');
  // Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
});
