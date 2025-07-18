<?php

namespace App\Models\Settings\LMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuerySubType extends Model
{
    use HasFactory;

    protected $fillable = ['name','query_types_id'];

    public function queryType()
    {
        return $this->belongsTo(QueryType::class,'query_types_id');
    }
}
