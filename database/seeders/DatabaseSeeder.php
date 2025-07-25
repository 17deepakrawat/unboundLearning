<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $this->call([
      RolePermissionSeeder::class,
      UserSeeder::class,
      LanguageSeeder::class,
      StudentStatus::class,
      CustomFieldSeeder::class,
      FilterFieldsSeeder::class,
      TasksSeeder::class,
      StageSeeder::class
    ]);
  }
}
