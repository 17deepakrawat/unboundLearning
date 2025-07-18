<?php

namespace App\Models\Settings\Admissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\FeeStructure;

class Scheme extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'vertical_id'];

  public function vertical()
  {
    return $this->belongsTo(Vertical::class,'vertical_id','id');
  }

  public function feeStructures()
  {
    return $this->belongsToMany(FeeStructure::class, 'scheme_fee_structure', 'scheme_id','fee_structure_id');
  }

  public function admissionSessionAdmissionType()
  {
    return $this->belongsToMany(AdmissionSessionAdmissionType::class, 'admission_session_admission_type_scheme')->withPivot('start_date');
  }
}
