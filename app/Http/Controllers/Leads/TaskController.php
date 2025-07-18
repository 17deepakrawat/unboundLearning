<?php

namespace App\Http\Controllers\Leads;

use App\Http\Controllers\Controller;
use App\Models\Leads\Lead;
use App\Models\Leads\LeadTask;
use App\Models\Leads\Opportunity;
use App\Models\Leads\OpportunityTask;
use App\Models\Settings\Leads\Stage;
use App\Models\Settings\Leads\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  public function createOnOpportunity($opportunityId, $taskId)
  {
    // Create a new task for the given opportunity and task id
    try {
      $opportunity = Opportunity::find($opportunityId);
      $task = Task::find($taskId);
      return view('leads.tasks.create', compact('opportunity', 'task'));
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Opportunity not found'
      ], 404);
    }
  }

  public function createOnLead($leadId, $taskId)
  {
    // Create a new task for the given opportunity and task id
    try {
      $lead = Lead::find($leadId);
      $task = Task::find($taskId);
      return view('leads.task-lead.create', compact('lead', 'task'));
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Opportunity not found'
      ], 404);
    }
  }

  public function storeOnOpportunity(Request $request)
  {
    // Store the new task for the given opportunity
    try {
      $opportunity = Opportunity::find($request->opportunityId);
      OpportunityTask::create([
        'opportunity_id' => $opportunity->id,
        'priority' => 'High',
        'task_id' => $request->taskId,
        'user_id' => $opportunity->user_id,
        'created_by' => Auth::user()->id,
        'due_date' => Carbon::createFromFormat("d-m-Y h:i A", $request->due_date)->format('Y-m-d H:i:00'),
      ]);
      return response()->json([
        'status' => 'success',
        'message' => 'Task created successfully!'
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function storeOnLead(Request $request)
  {
    // Store the new task for the given opportunity
    try {
      $lead = Lead::find($request->leadId);
      LeadTask::create([
        'lead_id' => $lead->id,
        'priority' => 'High',
        'task_id' => $request->taskId,
        'user_id' => $lead->user_id,
        'created_by' => Auth::user()->id,
        'due_date' => Carbon::createFromFormat("d-m-Y h:i A", $request->due_date)->format('Y-m-d H:i:00'),
      ]);
      return response()->json([
        'status' => 'success',
        'message' => 'Task created successfully!'
      ], 201);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => $e->getMessage()
      ], 500);
    }
  }

  public function editOnOpportunity($id)
  {
    // Edit the given task
    try {
      $task = OpportunityTask::with('task', 'opportunity')->find($id);
      $stages = Stage::all();
      return view('leads.tasks.edit', compact('task', 'stages'));
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Task not found'
      ], 404);
    }
  }

  public function editOnLead($id)
  {
    // Edit the given task
    try {
      $task = LeadTask::with('task', 'lead')->find($id);
      $stages = Stage::all();
      return view('leads.task-lead.edit', compact('task', 'stages'));
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Task not found'
      ], 404);
    }
  }

  public function updateOnOpportunity(Request $request)
  {
    // Update the given task
    try {
      $task = OpportunityTask::with('task', 'opportunity')->find($request->taskId);

      // Update Stage
      $opportunity = Opportunity::find($task->opportunity->id);
      $opportunity->stage_id = $request->stage_id;
      $opportunity->sub_stage_id = $request->sub_stage_id;
      $opportunity->save();

      // Update Task
      $task->completed_on = Carbon::now();
      $task->completed_by = Auth::user()->id;
      $task->remark = $request->remark;
      $task->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Task updated successfully!'
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Task not found'
      ], 404);
    }
  }

  public function updateOnLead(Request $request)
  {
    // Update the given task
    try {
      $task = LeadTask::with('task', 'lead')->find($request->taskId);

      // Update Stage
      $lead = Lead::find($task->lead->id);
      $lead->stage_id = $request->stage_id;
      $lead->sub_stage_id = $request->sub_stage_id;
      $lead->save();

      // Update Task
      $task->completed_on = Carbon::now();
      $task->completed_by = Auth::user()->id;
      $task->remark = $request->remark;
      $task->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Task updated successfully!'
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Task not found'
      ], 404);
    }
  }
}
