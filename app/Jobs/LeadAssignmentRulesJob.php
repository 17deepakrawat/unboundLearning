<?php

namespace App\Jobs;

use App\Models\Leads\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Settings\Leads\AssignmentRule; // Assuming Rule is the model for storing rules
use Illuminate\Support\Facades\Log;

class LeadAssignmentRulesJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $requestData;
  protected $leadId;

  /**
   * Create a new job instance.
   *
   * @param array $requestData
   */
  public function __construct(array $requestData, $leadId)
  {
    $this->requestData = $requestData;
    $this->leadId = $leadId;
    Log::info('LeadAssignmentRulesJob Constructed', [
      'requestData' => $this->requestData,
      'leadId' => $this->leadId,
    ]);
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $lead = Lead::find($this->leadId);
    if (!$lead) {
      return; // Handle case if lead is not found
    }

    Log::info('Lead found', ['leadId' => $this->leadId]);
    // Fetch all rules from the database
    $rules = AssignmentRule::all();
    foreach ($rules as $rule) {
      $rule = json_decode($rule->rule, true);
      $ifConditions = $rule['if'] ?? [];
      $thenLogic = $rule['then'] ?? [];

      if ($this->validateConditions($ifConditions)) {
        $this->applyActions($thenLogic);
        return;
      }
    }
  }

  /**
   * Validate "if" conditions against request data.
   *
   * @param array $conditions
   * @return bool
   */
  private function validateConditions(array $conditions)
  {
    foreach ($conditions as $condition) {
      $field = $condition['schema'] ?? null;
      $expectedValues = $condition['value'] ?? [];
      $operator = $condition['operator'] ?? 'Equal To';

      if (!$field || !isset($this->requestData[$field])) {
        return false; // Field is missing in the input
      }

      $fieldValue = $this->requestData[$field];

      switch ($operator) {
        case 'Equal To':
          if (!in_array($fieldValue, $expectedValues)) {
            return false;
          }
          break;
        case 'Not Equal To':
          if (in_array($fieldValue, $expectedValues)) {
            return false;
          }
          break;
        case 'Greater Than':
          if (!is_numeric($fieldValue) || $fieldValue <= $expectedValues[0]) {
            return false;
          }
          break;
        case 'Less Than':
          if (!is_numeric($fieldValue) || $fieldValue >= $expectedValues[0]) {
            return false;
          }
          break;
        case 'Greater Than or Equal To':
          if (!is_numeric($fieldValue) || $fieldValue < $expectedValues[0]) {
            return false;
          }
          break;
        case 'Less Than or Equal To':
          if (!is_numeric($fieldValue) || $fieldValue > $expectedValues[0]) {
            return false;
          }
          break;
        default:
          return false; // Unsupported operator
      }
    }

    return true; // All conditions are met
  }

  /**
   * Apply "then" actions based on the matched rule.
   *
   * @param array $actions
   */
  private function applyActions(array $actions)
  {
    $roleIds = $actions['role_ids'] ?? [];
    $distributionRule = $actions['distribution_rule'] ?? 'Round Robin';

    $lead = Lead::find($this->leadId);
    if (!$lead) {
      return;
    }

    // Fetch users with specified roles
    $roles = Role::whereIn('id', $roleIds)->get();
    if ($roles->isEmpty()) {
      $user = User::role('Super Admin')->first();
      $lead->user_id = $user->id;
      $lead->save();
      return;
    }

    $users = User::role($roles->pluck('name')->toArray())->get();
    if ($users->isEmpty()) {
      $user = User::role('Super Admin')->first();
      $lead->user_id = $user->id;
      $lead->save();
      return;
    }

    // Apply the distribution rule
    if ($distributionRule === 'Round Robin') {
      $lastAssignedUserId = cache('last_assigned_user_id');

      $nextUser = $users->sortBy('id')->filter(function ($user) use ($lastAssignedUserId) {
        return $user->id > $lastAssignedUserId;
      })->first();

      if (!$nextUser) {
        $nextUser = $users->sortBy('id')->first();
      }

      $lead->user_id = $nextUser->id;
      $lead->save();

      cache(['last_assigned_user_id' => $nextUser->id]);

      // Perform your actions with $nextUser
      // Example: Log, notify, or update assignment
    } elseif ($distributionRule === 'Random') {
      $randomUser = $users->random(); // Get a random user
      $lead->user_id = $randomUser->id;
      $lead->save();

      // Perform your actions with $randomUser
      // Example: Log, notify, or update assignment
    }
  }
}
