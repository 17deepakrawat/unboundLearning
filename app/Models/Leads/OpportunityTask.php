<?php

namespace App\Models\Leads;

use App\Models\Settings\Leads\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunityTask extends Model
{
  use HasFactory;
  protected $fillable = ['opportunity_id', 'task_id', 'user_id', 'created_by', 'due_date', 'remark', 'priority'];

  // Relationships
  public function opportunity()
  {
    return $this->belongsTo(Opportunity::class);
  }

  public function task()
  {
    return $this->belongsTo(Task::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function createdBy()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function completedBy()
  {
    return $this->belongsTo(User::class, 'completed_by');
  }
}
