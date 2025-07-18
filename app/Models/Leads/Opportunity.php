<?php

namespace App\Models\Leads;

use App\Models\Academics\Program;
use App\Models\Academics\Specialization;
use App\Models\Academics\StudentDocument;
use App\Models\Academics\Vertical;
use App\Models\Account\OpportunityLedger;
use App\Models\Settings\Admissions\AdmissionSession;
use App\Models\Settings\Admissions\AdmissionType;
use App\Models\Settings\Admissions\Scheme;
use App\Models\Settings\Admissions\StudentStatus;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubStage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Opportunity extends Model
{
  use HasFactory;

  protected $fillable = [
    'lead_id',
    'name',
    'email',
    'country_code',
    'phone',
    'student_id',
    'stage_id',
    'sub_stage_id',
    'user_id',
    'vertical_id',
    'program_id',
    'specialization_id',
    'source_campaign'
  ];

  public function lead()
  {
    return $this->belongsTo(Lead::class, 'lead_id', 'id')->with('source', 'subSource', 'country', 'state', 'city');
  }

  public function vertical()
  {
    return $this->belongsTo(Vertical::class, 'vertical_id', 'id');
  }

  public function stage()
  {
    return $this->belongsTo(Stage::class, 'stage_id', 'id');
  }

  public function subStage()
  {
    return $this->belongsTo(SubStage::class, 'sub_stage_id', 'id');
  }

  public function program()
  {
    return $this->belongsTo(Program::class, 'program_id', 'id');
  }

  public function specialization()
  {
    return $this->belongsTo(Specialization::class, 'specialization_id', 'id')->with('department', 'programType', 'program','constantFees');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function opportunityCustomFields()
  {
    return $this->hasMany(OpportunityCustomField::class, 'opportunity_id', 'id');
  }

  public function admissionSession()
  {
    return $this->belongsTo(AdmissionSession::class, 'admission_session_id', 'id');
  }

  public function admissionType()
  {
    return $this->belongsTo(AdmissionType::class, 'admission_type_id', 'id');
  }

  public function applicationOwner()
  {
    return $this->belongsTo(User::class, 'application_owner_id', 'id');
  }

  public function studentStatus()
  {
    return $this->belongsTo(StudentStatus::class, 'student_status_id', 'id');
  }

  public function tasks()
  {
    return $this->hasMany(OpportunityTask::class, 'opportunity_id', 'id')->with('task', 'user', 'createdBy', 'completedBy');
  }

  public function opportunityLedger()
  {
    return $this->hasMany(OpportunityLedger::class, 'opportunity_id', 'id')->with('payment', 'walletTransaction');
  }

  public function scheme()
  {
    return $this->belongsTo(Scheme::class,'scheme_id','id');
  }
}
