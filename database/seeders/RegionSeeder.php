<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $path = 'database/countries_states_cities/countries.sql';
    DB::unprepared(file_get_contents($path));
    $this->command->info('Country table seeded!');

    $path = 'database/countries_states_cities/states.sql';
    DB::unprepared(file_get_contents($path));
    $this->command->info('State table seeded!');

    $path = 'database/countries_states_cities/cities.sql';
    DB::unprepared(file_get_contents($path));
    $this->command->info('City table seeded!');
  }
}
