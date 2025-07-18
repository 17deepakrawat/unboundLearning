<?php

namespace App\Models\Settings\Admissions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Academics\Vertical;

class FeeStructure extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'vertical_id', 'applicable_on', 'has_sharing', 'is_constant'];

  protected $casts = array(
    'has_sharing' => 'boolean',
    'is_constant' => 'boolean',
    'is_active' => 'boolean',
  );


  // Relationships

  public function vertical()
  {
    return $this->belongsTo(Vertical::class,'vertical_id','id');
  }


  public function schemes() {
    return $this->belongsToMany(Scheme::class, 'scheme_fee_structure', 'scheme_id', 'fee_structure_id');
    //return $this->hasMany(Scheme::class);
  }

}
