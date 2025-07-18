<?php

namespace App\Models\Settings\Leads;

use App\Models\Leads\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
  use HasFactory;

  protected $fillable = [
    'name'
  ];

  public function subStages()
  {
    return $this->hasMany(SubStage::class);
  }

  public function leads()
  {
    return $this->hasMany(Lead::class);
  }
}
