<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Admissions\Scheme;
use App\Models\Settings\Admissions\FeeStructure;
use App\Models\Academics\Department;
use App\Models\Settings\Admissions\AdmissionSession;
use App\Models\Settings\Admissions\AdmissionType;
use App\Models\Settings\Admissions\EligibilityCriterion;
use App\Models\SpecializationVertical;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Vertical extends Model
{
  use HasFactory, Searchable;

  protected $fillable = [
    'name',
    'slug',
    'short_name',
    'vertical_name',
    'for_website',
    'for_panel',
    'logo',
    'is_active',
    'certificate',
    'content'
  ];

  protected $casts = [
    'for_website' => 'boolean',
    'for_panel' => 'boolean',
    'images' => 'array'
  ];

  public static function boot()
  {
    parent::boot();

    static::creating(function ($vertical) {
      $vertical->slug = Str::slug($vertical->name . ' ' . $vertical->vertical_name);
    });

    static::updating(function ($vertical) {
      $vertical->slug = Str::slug($vertical->name . ' ' . $vertical->vertical_name);
    });
  }

  // Attributes
  public function getFullNameAttribute()
  {
    return "{$this->name} ({$this->vertical_name})";
  }

  // Relationships

  public function departments()
  {
    return $this->belongsToMany(Department::class)->withPivot(['id', 'is_active']);
  }

  public function admissionTypes()
  {
    return $this->hasMany(AdmissionType::class);
  }

  public function schemes()
  {
    return $this->hasMany(Scheme::class)->with('feeStructures');
  }

  public function feeStructures()
  {
    return $this->hasMany(FeeStructure::class);
  }

  public function admissionSessions()
  {
    return $this->hasMany(AdmissionSession::class);
  }

  public function eligibilityCriteria()
  {
    return $this->belongsToMany(EligibilityCriterion::class);
  }

  public function specialization()
  {
    return $this->belongsTo(SpecializationVertical::class);
  }

  public function toSearchableArray(): array
    {
        $array['name'] = $this->name;
        $array['slug'] = $this->slug;
        $array['short_name'] = $this->short_name;
        $array['vertical_name'] = $this->vertical_name;
        $array['content'] = $this->content;
        return $array;
    }
}
