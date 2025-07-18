<?php

namespace Database\Seeders;

use App\Models\Settings\Leads\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Task::create(['name' => 'Make Phone Call']);
  }
}
