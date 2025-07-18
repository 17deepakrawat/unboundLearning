<?php

namespace App\Models\Settings\LMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
