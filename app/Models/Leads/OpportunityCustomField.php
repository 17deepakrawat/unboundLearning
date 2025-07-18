<?php

namespace App\Models\Leads;

use App\Models\Settings\Leads\CustomField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityCustomField extends Model
{
  use HasFactory;

  protected $table = "opportunity_custom_fields";


  protected $fillable = [
    'opportunity_id'
  ];

  public function opportunity()
  {
    return $this->belongsTo(Opportunity::class, 'opportunity_id', 'id');
  }
}
