<?php

namespace App\Providers;

use App\Helpers\Helpers;
use App\Models\Account\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WalletServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    View::composer('*', function ($view) {
      if (Auth::check()) {
        $wallets = Wallet::where('user_id', Auth::id())->with('vertical', 'walletTransactions')->get();

        // Group wallets by vertical and sum walletTransactions amounts
        $totalAmountByVertical = $wallets->groupBy('vertical_id')->map(function ($wallets) {
          return [
            'vertical' => $wallets->first()->vertical->short_name . ' (' . $wallets->first()->vertical->vertical_name . ')', // Assuming vertical has a 'name' field
            'amount' => $wallets->sum(function ($wallet) {
              return $wallet->walletTransactions->sum(function ($transaction) {
                return $transaction->type === 'deposit'
                  ? $transaction->amount
                  : -$transaction->amount;
              });
            })
          ];
        })->toArray();
        $view->with(['amountInWalletByVerticals' => $totalAmountByVertical, 'totalAmountInWallet' => Helpers::formatIndianCurrency(array_sum(array_column($totalAmountByVertical, 'amount')))]);
      }
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    //
  }
}
