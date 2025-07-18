<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProgramType extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'for_website',
    'is_skill'
  ];

  public static function boot()
  {
    parent::boot();

    static::creating(function ($programType) {
      $programType->slug = Str::slug($programType->name);
    });

    static::updating(function ($programType) {
      $programType->slug = Str::slug($programType->name);
    });
  }

  // Relationships
  public function departments()
  {
    return $this->belongsToMany(Department::class, 'program_type_department');
  }

  public function programs()
  {
    return $this->belongsToMany(Program::class);
  }

  public function departmentVerticals()
  {
    return $this->belongsToMany(DepartmentVertical::class, 'program_type_department_vertical')->withPivot('is_active')->with(['department', 'vertical']);
  }
}
