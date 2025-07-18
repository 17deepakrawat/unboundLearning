<?php

namespace App\Models\Settings\LMS;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $fillable = [
        'title',
        'vertical_id',
        'specialization_id',
        'duration',
        'description',
        'attachment',
        'type'
    ];
}
