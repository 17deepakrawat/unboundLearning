<?php

namespace App\Models;

use App\Models\Leads\Lead;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
        'title',
        'description',
        'student_id',
        'source',
        'source_id'
    ];
     
    public function student()
    {
        return $this->belongsTo(Lead::class,'student_id','id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class,'questions_id','id')->with('student');
    }
}
