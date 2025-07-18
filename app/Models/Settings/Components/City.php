<?php

namespace App\Models\Settings\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use HasFactory;

  // Relationship

  public function state()
  {
    return $this->belongsTo(State::class);
  }
}
