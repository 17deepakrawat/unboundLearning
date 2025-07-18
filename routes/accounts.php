<?php

use App\Http\Controllers\Accounts\OfflinePaymentController;
use App\Http\Controllers\Accounts\WalletPaymentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

  // Offline Payment
  Route::get(
    '/accounts/offline-payments',
    [OfflinePaymentController::class, 'index']
  )->name('accounts.offline-payments');

  Route::get(
    '/accounts/offline-payments/create',
    [OfflinePaymentController::class, 'create']
  )->name('accounts.offline-payments.create');

  Route::post(
    '/accounts/offline-payments',
    [OfflinePaymentController::class, 'store']
  )->name('accounts.offline-payments.store');

  Route::put(
    '/accounts/offline-payments/change-status',
    [OfflinePaymentController::class, 'status']
  )->name('accounts.offline-payments.change-status');

  // Wallet
  Route::get('/accounts/wallet-payments', [WalletPaymentController::class, 'index'])->name('accounts.wallet-payments');
});
