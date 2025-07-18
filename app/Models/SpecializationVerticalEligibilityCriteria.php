<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationVerticalEligibilityCriteria extends Model
{
    use HasFactory;
    protected $table = 'specialization_vertical_eligibility';
    protected $fillable = [
        'specialization_vertical_id',
        'required_eligibility_criteria_id',
        'optional_eligibility_criteria_id'
    ];

    public function specialization()
    {
        $this->belongsToMany(SpecializationVertical::class)->wherePivot('specialization_vertical_id','required_eligibility_criteria_id','optional_eligibility_criteria_id');
    }
}
