<?php

namespace App\Models\Settings\Admissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Academics\Vertical;
use App\Models\Settings\Admissions\AdmissionType;

use App\Models\Settings\Admissions\Scheme;
use Illuminate\Support\Carbon;

class AdmissionSession extends Model
{
  use HasFactory;
  protected $fillable = ['month', 'year', 'vertical_id'];

  public function getNameAttribute()
  {
    return Carbon::createFromFormat('Y-m', $this->year . '-' . $this->month)->format('M-Y');
  }

  // Relationships
  public function vertical()
  {
    return $this->belongsTo(Vertical::class, 'vertical_id', 'id');
  }

  public function admissionTypes()
  {
    return $this->belongsToMany(AdmissionType::class);
  }

  public function admissionSessionAdmissionTypes()
  {
    return $this->hasMany(AdmissionSessionAdmissionType::class)->with('schemes', 'admissionType');
  }

}
