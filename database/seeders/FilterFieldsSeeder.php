<?php

namespace Database\Seeders;

use App\Models\FilterFields;
use App\Models\Settings\Leads\CustomField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FilterFieldsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $fieldsArray = [
      // ['name' => 'Vertical', 'type' => 'Dropdown', 'schema' => 'vertical_id',  'use_for' => 'opportunity', 'is_core_field' => 1],
      // ['name' => 'Department', 'type' => 'Dropdown', 'schema' => 'department_id',  'use_for' => 'opportunity','is_core_field'=>1],
      // ['name' => 'Program Type', 'type' => 'Dropdown', 'schema' => 'program_type_id',  'use_for' => 'opportunity','is_core_field'=>1],
      // ['name' => 'Program', 'type' => 'Dropdown', 'schema' => 'program_id',  'use_for' => 'both', 'is_core_field' => 1],
      // ['name' => 'Specialization', 'type' => 'Dropdown', 'schema' => 'specialization_id',  'use_for' => 'both', 'is_core_field' => 1],
      // ['name' => 'Application Owner', 'type' => 'Dropdown', 'schema' => 'application_owner_id',  'use_for' => 'opportunity', 'is_core_field' => 1],
      // ['name' => 'Admission Session', 'type' => 'Dropdown', 'schema' => 'admission_session_id',  'use_for' => 'opportunity', 'is_core_field' => 1],
      // ['name' => 'Admission Type', 'type' => 'Dropdown', 'schema' => 'admission_type_id',  'use_for' => 'opportunity', 'is_core_field' => 1],
      // ['name' => 'Admission Duration', 'type' => 'Dropdown', 'schema' => 'admission_duration',  'use_for' => 'opportunity', 'is_core_field' => 1],
      // ['name' => 'First Name', 'type' => 'Text', 'schema' => 'first_name',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'Last Name', 'type' => 'Text', 'schema' => 'last_name',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'Email', 'type' => 'Email', 'schema' => 'email',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'Phone', 'type' => 'Phone', 'schema' => 'phone',  'use_for' => 'lead', 'is_core_field' => 1, 'is_intl_phone' => 1],
      // ['name' => 'Country', 'type' => 'Dropdown', 'schema' => 'country_id',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'State', 'type' => 'Dropdown', 'schema' => 'state_id',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'City', 'type' => 'Dropdown', 'schema' => 'city_id',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'Zip Code', 'type' => 'Number', 'schema' => 'zip_code',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'Address', 'type' => 'Textarea', 'schema' => 'address',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'DOB', 'type' => 'Date', 'schema' => 'date_of_birth',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'Mobile', 'type' => 'Phone', 'schema' => 'mobile',  'use_for' => 'lead', 'is_core_field' => 1, 'is_intl_phone' => 1],
      // ['name' => 'Alternate Email', 'type' => 'Email', 'schema' => 'alternate_email',  'use_for' => 'lead', 'is_core_field' => 1],
      // ['name' => 'Profile Photo', 'type' => 'File', 'schema' => 'avatar',  'use_for' => 'lead', 'extension' => json_encode(['.jpg', '.jpeg', '.png', '.heic', '.JPG', '.JPEG', '.PNG'])],
      ['name' => 'Source', 'type' => 'Dropdown', 'schema' => 'source_id', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'Sub Source', 'type' => 'Dropdown', 'schema' => 'sub_source_id', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'Source Campaign', 'type' => 'Text', 'schema' => 'source_campaign', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Source Medium', 'type' => 'Text', 'schema' => 'source_medium', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Ad group', 'type' => 'Text', 'schema' => 'ad_group', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Ad Name', 'type' => 'Text', 'schema' => 'ad_name', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Website', 'type' => 'Text', 'schema' => 'website', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Origin', 'type' => 'Text', 'schema' => 'origin', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Can Login', 'type' => 'Number', 'schema' => 'can_login', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Phone Varified On', 'type' => 'Date', 'schema' => 'phone_verified_on', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'Email Varified On', 'type' => 'Date', 'schema' => 'email_verified_on', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'Stage', 'type' => 'Dropdown', 'schema' => 'stage_id', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Sub Stage', 'type' => 'Dropdown', 'schema' => 'sub_stage_id', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'User', 'type' => 'Dropdown', 'schema' => 'user_id', 'use_for' => 'both', 'is_core_field' => 1],
      ['name' => 'Gender', 'type' => 'Text', 'schema' => 'gender', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'Planning To Start In', 'type' => 'Text', 'schema' => 'planning_to_stat_in', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'For Whom', 'type' => 'Text', 'schema' => 'for_whom', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'Last Qualification', 'type' => 'Text', 'schema' => 'last_qualification', 'use_for' => 'lead', 'is_core_field' => 1],
      ['name' => 'Student Status', 'type' => 'Dropdown', 'schema' => 'student_status_id', 'use_for' => 'opportunity', 'is_core_field' => 1],
      ['name' => 'Scheme', 'type' => 'Dropdown', 'schema' => 'scheme_id', 'use_for' => 'opportunity', 'is_core_field' => 1],
      ['name' => 'Student ID', 'type' => 'Text', 'schema' => 'student_id', 'use_for' => 'opportunity', 'is_core_field' => 1],
    ];
    $customFields = new CustomField;
    foreach ($fieldsArray as $fields) {
      if ($customFields->where('schema', $fields['schema'])->count() == 0) {
        $customFields->insert($fields);
      } else {
        $customFields->where('schema', $fields['schema'])->update($fields);
      }
    }
  }
}
