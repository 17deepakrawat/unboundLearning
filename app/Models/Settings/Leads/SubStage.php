<?php

namespace App\Models\Settings\Leads;

use App\Models\Leads\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStage extends Model
{
  use HasFactory;

  protected $fillable = ['stage_id', 'name'];

  // Relationships

  public function stage()
  {
    return $this->belongsTo(Stage::class, 'stage_id', 'id');
  }

  public function leads()
  {
    return $this->hasMany(Lead::class);
  }
}
