<?php

namespace App\Models\Settings\Leads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomField extends Model
{
  use HasFactory;

  protected $table = "custom_fields";

  protected $fillable = [
    'name',
    'options',
    'schema',
    'dependent',
    'mandatory',
    'validation',
    'type',
    'extension',
    'is_active',
    'is_multiple',
    'is_intl_phone',
    'sub_type',
    'size',
    'use_for',
    'max_selection',
    'pre_selected_options',
  ];

  // Relationships

  public function parent()
  {
    return $this->belongsTo(CustomField::class, 'dependent');
  }

  public function child()
  {
    return $this->hasOne(CustomField::class, 'dependent');
  }
}
