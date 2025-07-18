<?php

namespace App\Models\Academics;

use App\Models\Settings\Leads\CustomField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationFields extends Model
{
  use HasFactory;
  protected $table = 'application_fields';
  protected $fillable = [
    'field_id',
    'step_id',
    'vertical_id',
    'position',
  ];

  public $timestamps = false;
  public function applicationFields()
  {
    return $this->belongsToMany(CustomField::class, 'application_fields', 'field_id', 'field_id', 'id')->with('parent', 'child')->withPivot('step_id', 'vertical_id');
  }

  public function customFields()
  {
    return $this->belongsTo(CustomField::class, 'field_id', 'id')->with('parent', 'child');
  }
}
