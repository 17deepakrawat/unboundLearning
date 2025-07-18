<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Account\OpportunityLedger;
use App\Models\Account\Wallet;
use App\Models\Account\WalletTransaction;
use App\Models\Leads\Opportunity;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubStage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletPaymentController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view wallet-payments')) {
      $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);
      $users = User::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
        return $query->whereIn('id', $downline);
      })->get();
      if ($request->ajax()) {
        $userId = $request->get('userId', null);
        $walletIds = Wallet::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
          return $query->whereIn('user_id', $downline);
        })->when($userId, function ($queryBuilder) use ($userId) {
          return $queryBuilder->where('user_id', $userId);
        })->pluck('id')->toArray();

        $data = WalletTransaction::whereIn('wallet_id', $walletIds)->with('wallet', 'opportunity', 'payment')->orderBy('created_at', 'DESC')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('type', function ($data) {
            return ucwords($data->type);
          })
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
            return $formatedDate;
          })->make(true);
      }

      return view('accounts.wallet-payments.index', compact('users'));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function paymentOnOpportunityStore(Request $request, $id)
  {
    $validate = $request->validate([
      'feeType' => 'required|string',
      'selectedDurations' => 'nullable|string',
      'totalAmount' => 'required|numeric',
      'totalAmountOnDurations' => 'required|string'
    ]);

    try {
      $opportunity = Opportunity::find($id);

      $walletBalance = 0;
      $wallet = Wallet::where('user_id', $opportunity->application_owner_id)->where('vertical_id', $opportunity->vertical_id)->first();
      if (!$wallet) {
        return response()->json(['status' => 'error', 'message' => 'Please add money to wallet!']);
      }

      $walletBalance = WalletTransaction::where('wallet_id', $wallet->id)->get()
        ->sum(fn($transaction) => $transaction->type === 'deposit'
          ? $transaction->amount
          : -$transaction->amount);


      if ($validate['totalAmount'] > $walletBalance) {
        return response()->json(['status' => 'error', 'message' => 'Insufficient balance in your wallet!']);
      }

      $meta = json_encode([
        'feeType' => $validate['feeType'],
        'selectedDurations' => $validate['selectedDurations'],
        'totalAmount' => $validate['totalAmount'],
        'totalAmountOnDurations' => json_decode($validate['totalAmountOnDurations'], true)
      ]);

      $payment = new WalletTransaction();
      $payment->wallet_id = $wallet->id;
      $payment->opportunity_id = $opportunity->id;
      $payment->type = 'withdrawal';
      $payment->particular = 'Fee Payment';
      $payment->source = "Opportunity";
      $payment->amount = $validate['totalAmount'];
      $payment->meta = $meta;
      $payment->save();

      $meta = json_decode($meta, true);

      // Add in Student Ledger
      $stage = Stage::where('is_final', 1)->first();
      $subStage = SubStage::where('stage_id', $stage->id)->where('name', 'Fee Paid')->first();
      if (!$subStage) {
        $subStage = new SubStage();
        $subStage->stage_id = $stage->id;
        $subStage->name = 'Fee Paid';
        $subStage->save();
      }

      $opportunity->stage_id = $stage->id;
      $opportunity->sub_stage_id = $subStage->id;
      $opportunity->save();

      if ($meta['feeType'] == 'Full') {
        $opportunityLedger = new OpportunityLedger();
        $opportunityLedger->opportunity_id = $opportunity->id;
        $opportunityLedger->wallet_transaction_id = $payment->id;
        $opportunityLedger->amount = $validate['totalAmount'];
        $opportunityLedger->payment_type = 'Full';
        $opportunityLedger->save();
      } else {
        foreach ($meta['totalAmountOnDurations'] as $duration => $amount) {
          $opportunityLedger = new OpportunityLedger();
          $opportunityLedger->opportunity_id = $payment->opportunity_id;
          $opportunityLedger->wallet_transaction_id = $payment->id;
          $opportunityLedger->amount = $amount;
          $opportunityLedger->payment_type = $meta['feeType'];
          $opportunityLedger->duration = $duration;
          $opportunityLedger->save();
        }
      }

      return response()->json(['status' => 'success', 'message' => 'Payment added successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }
}
