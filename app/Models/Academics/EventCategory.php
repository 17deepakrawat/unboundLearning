<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'color'];

  public function events()
  {
    return $this->hasMany(Event::class);
  }
}
