<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramProgramTypeDepartmentVertical extends Model
{
  use HasFactory;

  protected $table = 'program_program_type_department_vertical';


  // Relationships

  public function program()
  {
    return $this->belongsTo(Program::class, 'program_id', 'id');
  }

  public function programTypeDepartmentVerticals()
  {
    return $this->belongsTo(ProgramTypeDepartmentVertical::class, 'program_type_department_vertical_id', 'id')->with('departmentVertical');
  }
}
