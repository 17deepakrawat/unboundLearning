<?php

namespace App\Models\Academics;

use App\Models\Settings\Admissions\PaperType;
use App\Models\Settings\Admissions\Scheme;
use App\Models\Settings\LMS\Ebook;
use App\Models\Settings\LMS\Note;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    use HasFactory;
    protected $fillable = [
        'vertical_id',
        'scheme_id',
        'program_id',
        'specialization_id',
        'duration',
        'name',
        'code',
        'paper_type_id',
        'credit',
        'minimum_marks',
        'maximum_marks',
        'department_id',
        'program_type_id'
    ];

    public function vertical()
    {
        return $this->belongsTo(Vertical::class);
    }

    public function paperType()
    {
        return $this->belongsTo(PaperType::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class)->with('program');
    }

    public function notes()
    {
        return $this->hasMany(Note::class,'syllabus_id');
    }

    public function ebooks()
    {
        return $this->hasMany(Ebook::class,'syllabus_id');
    }
}
