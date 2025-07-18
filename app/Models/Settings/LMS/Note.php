<?php

namespace App\Models\Settings\LMS;

use App\Models\Academics\Chapter;
use App\Models\Academics\Topic;
use App\Models\Academics\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'vertical_id',
        'specialization_id',
        'scheme_id',
        'syllabus_id',
        'name',
        'chapters_id',
        'units_id',
        'topics_id',
        'file_path',
        'is_active'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class,'chapters_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class,'units_id');
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class,'topics_id');
    }
}
