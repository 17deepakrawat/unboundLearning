<?php

namespace App\Models;

use App\Models\Leads\Lead;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'student_id',
        'answer',
        'questions_id'
    ];

    public function student()
    {
        return $this->belongsTo(Lead::class,'student_id','id');
    }
}
