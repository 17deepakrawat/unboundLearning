<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::create([
      'name' => 'Super Admin',
      'email' => 'superadmin@example.com',
      'password' => Hash::make('password'),
      'mobile'=>'123456789'
    ]);

    $role = Role::where('name', 'Super Admin')->first();
    $user->assignRole([$role->id]);
  }
}
