<?php

namespace App\Models\Settings\Admissions;

use App\Models\Academics\Vertical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Academics\Program;
use App\Models\Academics\Specialization;

class EligibilityCriterion extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  // Relationships

  public function verticals()
  {
    return $this->belongsToMany(Vertical::class)->select(['id', 'name', 'short_name', 'vertical_name']);
  }

  public function programs()
  {
    return $this->belongsToMany(Program::class);
  }

  public function specializations()
  {
    return $this->belongsToMany(Specialization::class);
  }
}
