<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    public $fillable = [
        'name',
        'mobile',
        'email',
        'message',
        'country_code',
    ];
}
