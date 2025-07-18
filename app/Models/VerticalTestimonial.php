<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerticalTestimonial extends Model
{
    public $fillable = [
        'name',
        'description',
        'designation',
        'image',
        'vertical_id'
    ];
}
