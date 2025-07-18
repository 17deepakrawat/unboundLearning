<?php

namespace App\Models;

use App\Models\Settings\Admissions\EligibilityCriterion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationVertical extends Model
{
  use HasFactory;

  protected $table = 'specialization_assign_vertical';
  protected $fillable = [
    'specialization_id',
    'admission_type_id',
    'admission_duration',
    'is_active',
    'required_eligibility_criteria_id',
    'optional_eligibility_criteria_id',
    'vertical_id',
  ];

  public function requiredEligibilityCriteria()
  {
    $this->belongsToMany(SpecializationVerticalEligibilityCriteria::class)->withPivot('required_eligibility_criteria_id');
  }
  public function optionalEligibilityCriteria()
  {
    $this->belongsToMany(SpecializationVerticalEligibilityCriteria::class)->withPivot('optional_eligibility_criteria_id');
  }
}
