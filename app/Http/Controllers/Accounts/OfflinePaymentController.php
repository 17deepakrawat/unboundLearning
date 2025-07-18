<?php

namespace App\Http\Controllers\Accounts;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Account\OpportunityLedger;
use App\Models\Account\Payment;
use App\Models\Account\Wallet;
use App\Models\Account\WalletTransaction;
use App\Models\Leads\Opportunity;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubStage;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OfflinePaymentController extends Controller
{
  public function index(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('view offline-payments')) {
      if ($request->ajax()) {
        $downline = Auth::user()->hasRole('Super Admin') ? "" : Helpers::getDownline(Auth::user()->id);
        $data = Payment::when(!Auth::user()->hasRole('Super Admin'), function ($query) use ($downline) {
          return $query->whereIn('user_id', $downline);
        })->with(['vertical', 'opportunity'])->orderBy('id', 'desc')->get();

        return Datatables::of($data)
          ->addIndexColumn()
          ->editColumn('file', function ($data) {
            return json_decode($data->file);
          })
          ->editColumn('created_at', function ($data) {
            $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at, 'UTC')->setTimezone(env('APP_TIMEZONE_NAME'))->format('d-m-Y h:i A');
            return $formatedDate;
          })->make(true);
      }
      return view('accounts.offline-payments.index');
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function create()
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create offline-payments')) {
      $users = Auth::user()->getRoleNames()[0] == 'Super Admin' ? User::withoutRole('Super Admin')->get() : Auth::user();
      return view('accounts.offline-payments.create', compact('users'));
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function store(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('create offline-payments')) {

      $request->validate([
        'user_id' => ['required', 'exists:users,id'],
        'vertical_id' => ['required', 'exists:verticals,id'],
        'beneficiary' => ['required'],
        'mode' => ['required'],
        'transaction_id' => ['required', 'max:255', 'unique:payments,transaction_id'],
        'transaction_date' => ['required', 'date'],
        'amount' => ['required', 'numeric', 'min:1'],
        'file' => ['required', 'mimes:jpeg,png,jpg,pdf']
      ]);

      if ($request->hasFile('file')) {
        $path = 'offline-payments';
        if (!File::exists(public_path($path))) {
          File::makeDirectory(public_path($path), 0777);
        }

        $path = $path . '/' . $request->user_id;
        if (!File::exists(public_path($path))) {
          File::makeDirectory(public_path($path), 0777);
        }

        $file = $request->file('file');
        $extension = $file->extension();
        $newFileName = uniqid() . '.' . $file->extension();
        $file->move(public_path($path), $newFileName);
        $fileUrl = $path . '/' . $newFileName;
      }

      try {
        $payment = new Payment();
        $payment->type = 'offline';
        $payment->user_id = $request->user_id;
        $payment->vertical_id =  $request->vertical_id;
        $payment->beneficiary =  $request->beneficiary;
        $payment->mode =  $request->mode;
        $payment->transaction_id =  $request->transaction_id;
        $payment->transaction_date = Carbon::createFromFormat("d-m-Y", $request->transaction_date)->format("Y-m-d");
        $payment->transaction_time = Carbon::now()->format("H:i:s");
        $payment->source = "Offline Payment Page";
        $payment->amount =  $request->amount;
        $payment->file =  isset($newFileName) ? json_encode(array('path' => $fileUrl, 'extension' => $extension)) : null;
        $payment->save();
        return response()->json(['status' => 'success', 'message' => 'Payment added successfully!']);
      } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
    } else {
      return response()->view('errors.403', [], 403);
    }
  }

  public function status(Request $request)
  {
    if (Auth::check() && Auth::user()->hasPermissionTo('edit offline-payments')) {
      try {
        $approvedBy = json_encode(['by' => Auth::user()->name, 'on' => date('Y-m-d H:i:s')]);

        $payment = Payment::find($request->id);
        $payment->status = $request->status;
        $payment->approved_by = $approvedBy;
        $payment->save();

        if ($request->status == 1) {
          $wallet = Wallet::where('user_id', $payment->user_id)->where('vertical_id', $payment->vertical_id)->first();
          if (!$wallet) {
            $wallet = new Wallet();
            $wallet->user_id = $payment->user_id;
            $wallet->vertical_id = $payment->vertical_id;
            $wallet->save();
          }

          // Add in Wallet Transactions
          if ($payment->opportunity_id) {
            $meta = json_decode($payment->meta, true);
            $totalAmountOnDurations = $meta['totalAmountOnDurations'];
            $opportunity = Opportunity::where('id', $payment->opportunity_id)->first();

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
              $opportunityLedger->opportunity_id = $payment->opportunity_id;
              $opportunityLedger->payment_id = $payment->id;
              $opportunityLedger->amount = $payment->amount;
              $opportunityLedger->payment_type = 'Full';
              $opportunityLedger->save();
            } else {
              foreach ($totalAmountOnDurations as $duration => $amount) {
                $opportunityLedger = new OpportunityLedger();
                $opportunityLedger->opportunity_id = $payment->opportunity_id;
                $opportunityLedger->payment_id = $payment->id;
                $opportunityLedger->amount = $amount;
                $opportunityLedger->payment_type = $meta['feeType'];
                $opportunityLedger->duration = $duration;
                $opportunityLedger->save();
              }
            }
          } else {
            $walletTransaction = new WalletTransaction();
            $walletTransaction->wallet_id = $wallet->id;
            $walletTransaction->type = 'deposit';
            $walletTransaction->amount = $payment->amount;
            $walletTransaction->payment_id = $payment->id;
            $walletTransaction->source = "Offline Payment";
            $walletTransaction->particular = 'Received offline payment for ' . $payment->beneficiary;
            $walletTransaction->save();
          }
        }

        return response()->json(['status' => 'success', 'message' => 'Payment status updated successfully!']);
      } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
      }
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
      'beneficiary' => 'required|string',
      'mode' => 'required|string',
      'transaction_id' => 'required|string|unique:payments,transaction_id',
      'transaction_date' => 'required|date',
      'amount' => 'required|numeric',
      'file' => 'mimes:jpeg,png,jpg,pdf',
      'totalAmountOnDurations' => 'required|string'
    ]);

    if ($request->hasFile('file')) {
      $path = 'offline-payments';
      if (!File::exists(public_path($path))) {
        File::makeDirectory(public_path($path), 0777);
      }

      $path = $path . '/opportunity';
      if (!File::exists(public_path($path))) {
        File::makeDirectory(public_path($path), 0777);
      }

      $path = $path . '/' . $id;
      if (!File::exists(public_path($path))) {
        File::makeDirectory(public_path($path), 0777);
      }

      $file = $request->file('file');
      $extension = $file->extension();
      $newFileName = uniqid() . '.' . $file->extension();
      $file->move(public_path($path), $newFileName);
      $fileUrl = $path . '/' . $newFileName;
    }

    try {
      $opportunity = Opportunity::find($id);

      $meta = json_encode([
        'feeType' => $validate['feeType'],
        'selectedDurations' => $validate['selectedDurations'],
        'totalAmount' => $validate['totalAmount'],
        'totalAmountOnDurations' => json_decode($validate['totalAmountOnDurations'], true)
      ]);

      $payment = new Payment();
      $payment->type = 'offline';
      $payment->user_id = Auth::user()->id;
      $payment->opportunity_id = $opportunity->id;
      $payment->vertical_id =  $opportunity->vertical_id;
      $payment->beneficiary =  $validate['beneficiary'];
      $payment->mode =  $validate['mode'];
      $payment->transaction_id =  $validate['transaction_id'];
      $payment->transaction_date = Carbon::createFromFormat("d-m-Y", $validate['transaction_date'])->format("Y-m-d");
      $payment->transaction_time = Carbon::now()->format("H:i:s");
      $payment->source = "Offline Payment Page";
      $payment->amount =  $validate['totalAmount'];
      $payment->meta = $meta;
      $payment->file =  isset($newFileName) ? json_encode(array('path' => $fileUrl, 'extension' => $extension)) : null;
      $payment->save();

      return response()->json(['status' => 'success', 'message' => 'Payment added successfully!']);
    } catch (\Exception $e) {
      return response()->json(['status' => 'error', 'message' => 'Something went wrong!', 'error' => $e->getMessage()]);
    }
  }
}
