<?php

namespace App\Models\Settings\Leads;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSource extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'source_id',
  ];


  // Relationships

  public function source()
  {
    return $this->belongsTo(Source::class, 'source_id', 'id');
  }
}
