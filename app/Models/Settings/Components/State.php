<?php

namespace App\Models\Settings\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  use HasFactory;

  // Relationship

  public function country()
  {
    return $this->belongsTo(Country::class);
  }

  public function cities()
  {
    return $this->hasMany(City::class);
  }
}
