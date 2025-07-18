<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  use HasFactory;

  protected $fillable = ['event_category_id', 'specialization_id', 'title', 'description', 'url', 'start_date', 'end_date', 'start_time', 'end_time', 'all_day', 'recurring', 'recurrence_type', 'recurrence_days'];

  public function eventCategory()
  {
    return $this->belongsTo(EventCategory::class);
  }

  public function specialization()
  {
    return $this->belongsTo(Specialization::class)->with('department', 'program', 'programType', 'mode');
  }

  protected $casts = [
    'recurrence_days' => 'array',
  ];
}
