<?php

namespace App\Models\Academics;

use App\Models\Leads\Opportunity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    use HasFactory;

    protected $table = 'student_documents';
    protected $fillable = [
        'opportunities_id',
        'status',
        'added_by',
        'approved_by',
        'pendency'
    ];

    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class);
    }
}
