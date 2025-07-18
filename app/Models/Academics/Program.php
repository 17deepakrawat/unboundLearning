<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Settings\Admissions\EligibilityCriterion;
use Laravel\Scout\Searchable;
class Program extends Model
{
  use HasFactory, Searchable;

  protected $fillable = ['name', 'short_name', 'slug', 'for_website', 'duration', 'is_paid', 'is_exclusive'];

  public static function boot()
  {
    parent::boot();

    static::creating(function ($program) {
      $program->slug = Str::slug($program->name);
    });

    static::updating(function ($program) {
      $program->slug = Str::slug($program->name);
    });
  }

  public function programTypes()
  {
    return $this->belongsToMany(ProgramType::class, 'program_program_type');
  }

  public function departments()
  {
    return $this->belongsToMany(Department::class, 'program_department');
  }

  public function eligibilityCriteria()
  {
    return $this->belongsToMany(EligibilityCriterion::class)->withPivot('is_required')->select(['id', 'name']);
  }

  public function programTypeDepartmentVerticals()
  {
    return $this->belongsToMany(ProgramTypeDepartmentVertical::class)->with(['programType', 'departmentVertical'])->withPivot('is_active');
  }

  public function specializations()
  {
    return $this->hasMany(Specialization::class)->with('mode', 'programType', 'department');
  }

  public function toSearchableArray(): array
    {
        return [
          'name'=>$this->name,
          'short_name'=>$this->short_name,
          'slug'=>$this->slug,
          'content'=>$this->content
        ];
    }
}
