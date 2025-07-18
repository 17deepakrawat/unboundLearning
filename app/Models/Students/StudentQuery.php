<?php

namespace App\Models\Students;

use App\Models\Settings\LMS\QuerySubType;
use App\Models\Settings\LMS\QueryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'query_type_id',
        'query_sub_type_id',
        'attachment',
        'description'
    ];

    public function queryType()
    {
        return $this->belongsTo(QueryType::class,'query_type_id');
    }

    public function querySubType()
    {
        return $this->belongsTo(QuerySubType::class,'query_sub_type_id');
    }
}
