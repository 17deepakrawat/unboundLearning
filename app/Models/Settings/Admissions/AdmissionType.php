<?php

namespace App\Models\Settings\Admissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\AdmissionSession;

class AdmissionType extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'vertical_id'];


  // Relationships
  public function vertical()
  {
    return $this->belongsTo(Vertical::class, 'vertical_id', 'id');
  }

  public function admissionSessions() {
    return $this->belongsToMany(AdmissionSession::class);
  }

  public function admissionSessionAdmissionType()
  {
    return $this->hasMany(AdmissionSessionAdmissionType::class);
  }

}
