<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentVertical extends Model
{
  use HasFactory;

  protected $table = 'department_vertical';

  public function programTypes()
  {
    return $this->belongsToMany(ProgramType::class, 'program_type_department_vertical')->withPivot('id', 'is_active');
  }

  public function vertical()
  {
    return $this->belongsTo(Vertical::class);
  }

  public function department()
  {
    return $this->belongsTo(Department::class)->select(['id', 'name']);
  }

  public function programTypesByVertical()
  {
    return $this->belongsToMany(ProgramType::class, 'program_type_department_vertical')->with('programs');
  }
}
