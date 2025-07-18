<?php

namespace App\Models\Settings\Admissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Academics\Vertical;

class StudentStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

  // Relationships

  public function verticals()
  {
    return $this->belongsToMany(Vertical::class)->withPivot(['id']);
  }
}
