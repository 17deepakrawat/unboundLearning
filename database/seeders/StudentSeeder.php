<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Students\Student;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::create([
            'name' => 'Abdul Qadir',
            'email' => 'qadirabdul313@gmail.com',
            'mobile' => '9911617502',
            'bio' => 'I am Qadir from delhi.',
            'dob' => '09-08-1990',
            'program_id' => 3,
            'specialization_id'=>  3,
            'created_at' => now(),
            'updated_at' => now()
          ]);
    }
}