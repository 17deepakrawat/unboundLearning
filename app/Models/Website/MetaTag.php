<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
  use HasFactory;

  protected $fillable = [
    'name', 'slug', 'meta'
  ];
}
