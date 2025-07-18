<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'specialization_id',
        'syllabi_id',
        'syllabus_code'
    ];
    public function units()
    {
        return $this->hasMany(Unit::class,'chapters_id')->with('topics');
    }
}
