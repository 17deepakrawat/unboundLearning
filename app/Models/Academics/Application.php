<?php

namespace App\Models\Academics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $fillable = [
            'center_id',
            'admission_session_id',
            'admission_type_id',
            'cources_id',
            'sub_cources_id',
            'course_category_id',
            'mode_id',
            'full_name',
            'father_name',
            'mother_name',
            'dob',
            'gender',
            'category',
            'marital_status',
            'religion',
            'aadhar_number',
            'nationality',
            'employement_status',
            'email',
            'contact',
            'address',
            'duration',
            'step_status',
            'vertical_id'
    ];
    public function dyamicform()
    {
        return $this->belongsTo(ApplicationForm::class,'application_id','id');
    }
}
