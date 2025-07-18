<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    public $fillable = [
        'name',
        'city',
        'state',
        'no_of_vacancy',
        'type',
        'shift_timing',
        'salary',
        'description'
    ];
}
