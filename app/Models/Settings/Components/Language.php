<?php

namespace App\Models\Settings\Components;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'locale'];
}
