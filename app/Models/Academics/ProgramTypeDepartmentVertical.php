<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Academics\DepartmentVertical;
use App\Models\Academics\Vertical;

class ProgramTypeDepartmentVertical extends Model
{
  use HasFactory;

  protected $table = 'program_type_department_vertical';

  public function scopeIsActive($query)
  {
    return $query->where('is_active', 1);
  }

  // Relationships

  public function programType()
  {
    return $this->belongsTo(ProgramType::class);
  }

  public function departmentVertical()
  {
    return $this->belongsTo(DepartmentVertical::class)->with(['department', 'vertical']);
  }

  public function programs()
  {
    return $this->belongsToMany(Program::class, 'program_program_type_department_vertical', 'program_type_department_vertical_id', 'program_id');
  }
}
