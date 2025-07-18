<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    public $fillable = [
        'user_name',
        'user_avatar',
        'comment',
        'blogs_id'
    ];
}
