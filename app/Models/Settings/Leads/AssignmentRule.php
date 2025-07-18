<?php

namespace App\Models\Settings\Leads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentRule extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'rule',
    'description'
  ];
}
