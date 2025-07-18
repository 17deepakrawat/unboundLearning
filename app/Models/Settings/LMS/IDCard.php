<?php

namespace App\Models\Settings\LMS;

use App\Models\Academics\Vertical;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IDCard extends Model
{
    use HasFactory;

    protected $table = 'id_cards';
    protected $fillable = [
        'vertical_id',
        'is_active',
        'design',
        'name'
    ];

    public function vartical()
    {
        return $this->belongsTo(Vertical::class,'vertical_id','id');
    }
}
