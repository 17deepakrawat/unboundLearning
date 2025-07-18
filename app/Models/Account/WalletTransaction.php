<?php

namespace App\Models\Account;

use App\Models\Leads\Opportunity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
  use HasFactory;

  protected $fillable = ['wallet_id', 'type', 'amount', 'particular', 'source'];

  public function wallet()
  {
    return $this->belongsTo(Wallet::class, 'wallet_id')->with('user', 'vertical');
  }

  public function opportunity()
  {
    return $this->belongsTo(Opportunity::class, 'opportunity_id');
  }

  public function payment()
  {
    return $this->belongsTo(Payment::class, 'payment_id');
  }
}
