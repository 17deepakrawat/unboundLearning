<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSteps extends Model
{
  use HasFactory;
  protected $table = 'application_steps';
  protected $fillable = [
    'title',
    'vertical_id',
    'position'
  ];

  public function fields()
  {
    return $this->hasMany(ApplicationFields::class, 'step_id', 'id')->orderBy('position')->with('customFields');
  }
}
