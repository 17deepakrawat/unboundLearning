<?php

namespace App\Models\Settings\Admissions;

use App\Models\Academics\Vertical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
  use HasFactory;
  protected $fillable = ['name'];

  // Relationships

  public function verticals()
  {
    return $this->belongsToMany(Vertical::class, 'mode_vertical');
  }
}
