<?php

namespace App\Models\Students;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'otp', 'expire_at'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}