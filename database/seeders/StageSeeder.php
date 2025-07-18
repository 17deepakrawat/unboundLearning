<?php

namespace Database\Seeders;

use App\Models\Settings\Leads\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $stages = array('New', 'Follow Up', 'Not Responing', 'Dump', 'Deal Done');
    foreach ($stages as $stageName) {
      $stage = new Stage();
      $stage->name = $stageName;
      $stage->save();
    }

    $stage = Stage::where('name', '=', 'New')->first();
    $stage->is_initial = true;
    $stage->save();

    $stage = Stage::where('name', '=', 'Deal Done')->first();
    $stage->is_final = true;
    $stage->save();
  }
}
