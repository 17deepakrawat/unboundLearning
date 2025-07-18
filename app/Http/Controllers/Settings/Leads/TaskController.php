<?php

namespace App\Http\Controllers\Settings\Leads;

use App\Http\Controllers\Controller;
use App\Models\Settings\Leads\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
  public function store(Request $request)
  {
    Task::create([$request->all()]);
  }
}
