<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'chapters_id',
        'syllabus_id'
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class,'units_id');
    }
}
