<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerTestimonial extends Model
{
    public $fillable = [
        'name',
        'description',
        'designation',
        'image'
    ];
}
