<?php

namespace Database\Seeders;

use App\Models\Settings\Admissions\StudentStatus as AdmissionsStudentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentStatus extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdmissionsStudentStatus::create(['name'=>'New','color'=>'#007bff']);
        AdmissionsStudentStatus::create(['name'=>'Active','color'=>'#28a745']);
        AdmissionsStudentStatus::create(['name'=>'InActive','color'=>'#ffc107']);
        AdmissionsStudentStatus::create(['name'=>'DropOut','color'=>'#ffc107']);
        AdmissionsStudentStatus::create(['name'=>'Cancel','color'=>'#dc3545']);
        AdmissionsStudentStatus::create(['name'=>'Refunnd','color'=>'#dc3545']);
        AdmissionsStudentStatus::create(['name'=>'Exit B','color'=>'#17a2b8']);
        AdmissionsStudentStatus::create(['name'=>'Exit AD','color'=>'#17a2b8']);
        AdmissionsStudentStatus::create(['name'=>'Exit D','color'=>'#17a2b8']);
        AdmissionsStudentStatus::create(['name'=>'Exit C','color'=>'#17a2b8']);
    }
}
