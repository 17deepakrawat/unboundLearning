<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteContent extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'slug',
    'content',
    'asset'
  ];
}
