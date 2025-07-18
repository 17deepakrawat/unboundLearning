<?php

namespace App\Models\Account;

use App\Models\Academics\Vertical;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
  use HasFactory;

  protected $fillable = ['user_id', 'vertical_id'];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function vertical()
  {
    return $this->belongsTo(Vertical::class, 'vertical_id');
  }

  public function walletTransactions()
  {
    return $this->hasMany(WalletTransaction::class);
  }
}
