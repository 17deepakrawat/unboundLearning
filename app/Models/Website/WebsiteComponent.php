<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteComponent extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'meta'];
}
