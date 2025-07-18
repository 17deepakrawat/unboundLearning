<?php

namespace App\Models\Account;

use App\Models\Academics\Vertical;
use App\Models\Leads\Opportunity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  use HasFactory;

  // Relationships
  public function vertical()
  {
    return $this->belongsTo(Vertical::class);
  }

  public function user()
  {
    return $this->hasOne(User::class);
  }

  public function opportunity()
  {
    return $this->belongsTo(Opportunity::class);
  }
}
