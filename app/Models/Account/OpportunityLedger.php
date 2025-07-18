<?php

namespace App\Models\Account;

use App\Models\Leads\Opportunity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityLedger extends Model
{
    use HasFactory;

  public function opportunity()
  {
    return $this->belongsTo(Opportunity::class, 'opportunity_id', 'id');
  }

  public function payment()
  {
    return $this->belongsTo(Payment::class, 'payment_id', 'id');
  }

  public function walletTransaction()
  {
    return $this->belongsTo(WalletTransaction::class, 'wallet_transaction_id', 'id');
  }
}
