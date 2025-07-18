<?php

namespace App\Models\Settings\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  use HasFactory;

  // Relationship

  public function states()
  {
    return $this->hasMany(State::class);
  }
}
