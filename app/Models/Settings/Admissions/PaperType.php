<?php

namespace App\Models\Settings\Admissions;

use App\Models\Academics\Vertical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'vertical_id'
    ];

    public function vertical()
    {
        return $this->belongsTo(Vertical::class);
    }
}
