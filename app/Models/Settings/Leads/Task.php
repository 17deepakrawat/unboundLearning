<?php

namespace App\Models\Settings\Leads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'fields',
  ];
}
