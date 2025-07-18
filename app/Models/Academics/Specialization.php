<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Settings\Admissions\EligibilityCriterion;
use App\Models\Settings\Admissions\Mode;

class Specialization extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'slug', 'program_id', 'department_id', 'program_type_id', 'mode_id', 'for_website', 'min_duration', 'max_duration', 'is_trending'];

  public static function boot()
  {
    parent::boot();

    static::creating(function ($specialization) {
      $specialization->slug = Str::slug($specialization->department->name . ' ' . $specialization->program->name . ' ' . $specialization->programType->name . ' ' . $specialization->name . ' ' . $specialization->min_duration . ' ' . $specialization->mode->name);
    });

    static::updating(function ($specialization) {
      $specialization->slug = Str::slug($specialization->department->name . ' ' . $specialization->program->name . ' ' . $specialization->programType->name . ' ' . $specialization->name . ' ' . $specialization->min_duration . ' ' . $specialization->mode->name);
    });
  }

  // Relationships

  public function program()
  {
    return $this->belongsTo(Program::class);
  }

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function programType()
  {
    return $this->belongsTo(ProgramType::class);
  }

  public function mode()
  {
    return $this->belongsTo(Mode::class);
  }

  public function eligibilityCriteria()
  {
    return $this->belongsToMany(EligibilityCriterion::class, 'specialization_eligibility_criterion')->withPivot('is_required')->select(['id', 'name']);
  }

  public function constantFees()
  {
    return $this->hasMany(ConstantFee::class)->with('vertical');
  }

  public function events()
  {
    return $this->hasMany(Event::class);
  }
}
