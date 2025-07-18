<?php

namespace App\Models\Academics;

use App\Models\Settings\Admissions\AdmissionType;
use App\Models\Settings\Admissions\FeeStructure;
use App\Models\Settings\Admissions\Scheme;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstantFee extends Model
{
  use HasFactory;

  protected $fillable = ['vertical_id', 'scheme_id', 'fee_structure_id', 'specialization_id', 'admission_type_id', 'fee_type', 'duration', 'fee'];

  public function feeStructure()
  {
    return $this->belongsTo(FeeStructure::class);
  }

  public function specialization()
  {
    return $this->belongsTo(Specialization::class);
  }

  public function admissionType()
  {
    return $this->belongsTo(AdmissionType::class, 'admission_type_id');
  }

  public function vertical()
  {
    return $this->belongsTo(Vertical::class);
  }

  public function scheme()
  {
    return $this->belongsTo(Scheme::class);
  }
}
