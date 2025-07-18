<?php

namespace App\Models\Settings\Admissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionSessionAdmissionType extends Model
{
  use HasFactory;

  protected $table = 'admission_session_admission_type';

  public function schemes()
  {
    return $this->belongsToMany(Scheme::class, 'admission_session_admission_type_scheme')->withPivot('start_date');
  }

  public function admissionSession()
  {
    return $this->belongsTo(AdmissionSession::class);
  }

  public function admissionType()
  {
    return $this->belongsTo(AdmissionType::class);
  }
}
