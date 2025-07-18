<?php

namespace App\Models\Leads;

use App\Models\Academics\Program;
use App\Models\Academics\Specialization;
use App\Models\Settings\Components\City;
use App\Models\Settings\Components\Country;
use App\Models\Settings\Components\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Leads\Source;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\SubSource;
use App\Models\Settings\Leads\SubStage;
use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Lead extends Authenticatable
{

  use HasFactory;
  protected $guard = 'student';
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'country_code',
    'phone',
    'source_id',
    'stage_id',
    'sub_stage_id',
    'user_id',
    'program_id',
    'sub_source_id',
    'date_of_birth',
    'avatar',
    'address',
    'country_id',
    'state_id',
    'city_id',
    'zip_code',
    'alternate_email',
    'mobile',
    'source_campaign',
    'source_medium',
    'ad_group',
    'ad_name',
    'website',
    'origin',
    'gender',
    'password'
  ];

  public function getFullNameAttribute()
  {
    return implode(" ", array_filter([$this->first_name, $this->last_name]));
  }

  // Relationships
  public function source()
  {
    return $this->belongsTo(Source::class, 'source_id', 'id');
  }

  public function subSource()
  {
    return $this->belongsTo(SubSource::class, 'sub_source_id', 'id');
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
    return $this->belongsTo(Specialization::class, 'specialization_id', 'id')->with('department', 'programType', 'program', 'constantFees');
  }

  public function country()
  {
    return $this->belongsTo(Country::class, 'country_id', 'id');
  }

  public function state()
  {
    return $this->belongsTo(State::class, 'state_id', 'id');
  }

  public function city()
  {
    return $this->belongsTo(City::class, 'city_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }

  public function opportunities()
  {
    return $this->hasMany(Opportunity::class, 'lead_id')->with('stage', 'subStage', 'vertical', 'program', 'specialization', 'user', 'admissionSession', 'admissionType', 'applicationOwner', 'studentStatus', 'opportunityCustomFields');
  }

  public function tasks()
  {
    return $this->hasMany(LeadTask::class, 'lead_id', 'id')->with('task', 'user', 'createdBy', 'completedBy');
  }
}
