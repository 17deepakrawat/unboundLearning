<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Components\Language;
use App\Models\Academics\Program;
use Illuminate\Support\Str;

class Department extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'for_website'];

  public static function boot()
  {
    parent::boot();

    static::creating(function ($department) {
      $department->slug = Str::slug($department->name);
    });

    static::updating(function ($department) {
      $department->slug = Str::slug($department->name);
    });
  }

  public function verticals()
  {
    return $this->belongsToMany(Vertical::class)->withPivot(['id', 'is_active']);
  }

  public function languages()
  {
    return $this->belongsToMany(Language::class, 'department_language');
  }

  public function programTypes()
  {
    return $this->belongsToMany(ProgramType::class, 'program_type_department');
  }

  public function programs()
  {
    return $this->belongsToMany(Program::class, 'program_department', 'department_id', 'program_id');
  }
}
