<?php

use App\Http\Controllers\Accounts\OfflinePaymentController;
use App\Http\Controllers\Academics\ApplicationController;
use App\Http\Controllers\Accounts\WalletPaymentController;
use App\Http\Controllers\Leads\LeadController;
use App\Http\Controllers\Leads\OpportunityController;
use App\Http\Controllers\Leads\TaskController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
  Route::get('/manage/leads/list', [LeadController::class, 'index'])->name('manage.leads.list');
  Route::get('/manage/leads/newsletter-subscribers', [LeadController::class, 'newsLetterSubscribers'])->name('manage.leads.newsletter-subscribers');
  Route::get('/manage/leads/export', [LeadController::class, 'export'])->name('manage.leads.export');
  Route::get('/manage/leads/view/{id}', [LeadController::class, 'view'])->name('manage.leads.view');
  Route::get('/manage/leads/create', [LeadController::class, 'create'])->name('manage.leads.create');
  Route::get('/manage/leads/edit/{id}', [LeadController::class, 'edit'])->name('manage.leads.edit');
  Route::put('/manage/leads/update/{id}', [LeadController::class, 'update'])->name('manage.leads.update');

  // Import
  Route::get('/manage/leads/import', [LeadController::class, 'showImport'])->name('manage.leads.import');
  Route::get('/manage/leads/import/download-sample', [LeadController::class, 'downloadSample'])->name('manage.leads.import.download-sample');
  Route::post('/manage/leads/import/store', [LeadController::class, 'importStore'])->name('manage.leads.import.store');
  Route::get('/manage/leads/import/status', [LeadController::class, 'downloadImportStatus'])->name('manage.leads.import.status');

  Route::get('/manage/leads/re-assign/{id}', [LeadController::class, 'reAssign']);
  Route::post('/manage/leads/re-assign/update/{id}', [LeadController::class, 'reAssignUpdate'])->name('manage.leads.re-assign.update');
  Route::post('/manage/leads/re-assign-multiple', [LeadController::class, 'reAssignMultiple']);
  Route::post('/manage/leads/re-assign-multiple/update', [LeadController::class, 'reAssignUpdateMultiple']);

  Route::post('/manage/leads/stages/update/{id}', [LeadController::class, 'changeStages'])->name('manage.leads.stages.update');
  Route::get('/manage/leads/stages/{id}', [LeadController::class, 'stages'])->name('manage.leads.stages');

  Route::get('/manage/leads/tasks', [LeadController::class, 'tasks'])->name('manage.leads.tasks');
  Route::get('/manage/leads/activities', [LeadController::class, 'activities'])->name('manage.leads.activities');

  Route::post('manage/leads/filter', [LeadController::class, 'index'])->name('manage.leads.filter');
  Route::post('manage/application/filter', [ApplicationController::class, 'index'])->name('manage.application.filter');

  // Task on Lead
  Route::get('/manage/lead/task/create/{leadId}/{taskId}', [TaskController::class, 'createOnLead']);
  Route::post('/manage/lead/task/store/', [TaskController::class, 'storeOnLead'])->name('manage.lead.task.store');
  Route::get('/manage/lead/task/edit/{id}', [TaskController::class, 'editOnLead'])->name('manage.lead.task.edit');
  Route::post('/manage/lead/task/update', [TaskController::class, 'updateOnLead'])->name('manage.lead.task.update');

  // Opportunity
  Route::post('/manage/opportunities', [OpportunityController::class, 'index'])->name('manage.opportunities');
  Route::get('/manage/opportunity/create/{leadId}', [OpportunityController::class, 'create']);
  Route::post('/manage/opportunity/store/{leadId}', [OpportunityController::class, 'store'])->name('manage.opportunity.store');
  Route::get('/manage/opportunity/edit/{id}', [OpportunityController::class, 'edit']);
  Route::put('/manage/opportunity/update/{id}', [OpportunityController::class, 'update'])->name('manage.opportunity.update');
  Route::get('/manage/opportunity/view/{id}', [OpportunityController::class, 'view'])->name('manage.opportunity.view');
  Route::post('/manage/opportunity/fee/payment/{id}', [OpportunityController::class, 'payment'])->name('manage.opportunity.fee.payment');
  Route::post('/manage/opportunity/fee/payment/method/{id}', [OpportunityController::class, 'paymentMethod'])->name('manage.opportunity.fee.payment.method');
  Route::post('/manage/opportunity/fee/payment/method/offline/store/{id}', [OfflinePaymentController::class, 'paymentOnOpportunityStore'])->name('manage.opportunity.fee.payment.method.offline.store');
  Route::post('/manage/opportunity/fee/payment/method/wallet/store/{id}', [WalletPaymentController::class, 'paymentOnOpportunityStore'])->name('manage.opportunity.fee.payment.method.wallet.store');
  Route::get('/manage/opportunity/send-to-university/{id}', [OpportunityController::class, 'sendToUniversity'])->name('manage.opportunity.send-to-university');
  Route::get('/manage/opportunity/send-welcome-email/{id}', [OpportunityController::class, 'sendWelcomeEmail'])->name('manage.opportunity.send-welcome-email');
  Route::get('/manage/opportunity/delete/{id}', [OpportunityController::class, 'delete'])->name('manage.opportunity.delete');

  // Task on Opportuity
  Route::get('/manage/opportunity/task/create/{opportunityId}/{taskId}', [TaskController::class, 'createOnOpportunity']);
  Route::post('/manage/opportunity/task/store/', [TaskController::class, 'storeOnOpportunity'])->name('manage.opportunity.task.store');
  Route::get('/manage/opportunity/task/edit/{id}', [TaskController::class, 'editOnOpportunity'])->name('manage.opportunity.task.edit');
  Route::post('/manage/opportunity/task/update', [TaskController::class, 'updateOnOpportunity'])->name('manage.opportunity.task.update');
});
Route::get('/manage/leads/create', [LeadController::class, 'create'])->name('manage.leads.create');
