<?php

namespace App\Models\Settings\Leads;

use App\Models\Leads\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  public function subSources()
  {
    return $this->hasMany(SubSource::class);
  }

  public function leads()
  {
    return $this->hasMany(Lead::class);
  }
}
