<?php

namespace Database\Seeders;

use App\Models\Settings\Leads\CustomField as LeadsCustomField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CustomFieldSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $customFieldArray = [
      ['name' => 'Vertical', 'type' => 'Dropdown', 'schema' => 'vertical_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Department', 'type' => 'Dropdown', 'schema' => 'department_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Program Type', 'type' => 'Dropdown', 'schema' => 'program_type_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Program', 'type' => 'Dropdown', 'schema' => 'program_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Specialization', 'type' => 'Dropdown', 'schema' => 'specialization_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Application Owner', 'type' => 'Dropdown', 'schema' => 'application_owner_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Admission Session', 'type' => 'Dropdown', 'schema' => 'admission_session_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Admission Type', 'type' => 'Dropdown', 'schema' => 'admission_type_id', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'Admission Duration', 'type' => 'Dropdown', 'schema' => 'admission_duration', 'is_core_field' => 1, 'use_for' => 'opportunity'],
      ['name' => 'First Name', 'type' => 'Text', 'schema' => 'first_name', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Last Name', 'type' => 'Text', 'schema' => 'last_name', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Email', 'type' => 'Email', 'schema' => 'email', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Phone', 'type' => 'Phone', 'schema' => 'phone', 'is_intl_phone' => 1, 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Country', 'type' => 'Dropdown', 'schema' => 'country_id', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'State', 'type' => 'Dropdown', 'schema' => 'state_id', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'City', 'type' => 'Dropdown', 'schema' => 'city_id', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Zip Code', 'type' => 'Number', 'schema' => 'zip_code', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Address', 'type' => 'Textarea', 'schema' => 'address', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'DOB', 'type' => 'Date', 'schema' => 'date_of_birth', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Mobile', 'type' => 'Phone', 'schema' => 'mobile', 'is_intl_phone' => 1, 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Alternate Email', 'type' => 'Email', 'schema' => 'alternate_email', 'is_core_field' => 1, 'use_for' => 'lead'],
      ['name' => 'Profile Photo', 'type' => 'File', 'schema' => 'avatar', 'is_core_field' => 1, 'use_for' => 'lead', 'extension' => json_encode(['.jpg', '.jpeg', '.png', '.heic', '.JPG', '.JPEG', '.PNG'])],
      ];
    $fieldConfigs = array(
      "Text" => array("type" => "string", "length" => "255"),
      "Textarea" => array("type" => "longtext", "length" => ""),
      "Phone" => array("type" => "string", "length" => "25"),
      "Email" => array("type" => "string", "length" => "255"),
      "Dropdown" => array("type" => "string", "length" => "255"),
      "Date" => array("type" => "date", "length" => ""),
      "Time" => array("type" => "time", "length" => ""),
      "Date Time" => array("type" => "timestamp", "length" => ""),
      "Dependent Dropdown" => array("type" => "string", "length" => "255"),
      "Boolean" => array("type" => "boolean", "length" => ""),
      "File" => array("type" => "text", "length" => "255"),
      "Number" => array("type" => "integer", "length" => ""),
      "Decimal" => array("type" => "float", "length" => ""),
    );
    $customFieldsController = new LeadsCustomField();

    foreach ($customFieldArray as $key => $field) {
      $customFieldsController->create($field);
      $fieldConfig = $fieldConfigs[$field['type']]['type'];
      $fieldLength = $fieldConfigs[$field['type']]['length'];
      $fieldName = $field['schema'];
      Schema::table('opportunity_custom_fields', function (Blueprint $table) use ($fieldConfig, $fieldName, $fieldLength) {
        if (!Schema::hasColumn('opportunity_custom_fields', $fieldName)) {
          if (!empty($fieldLength)) {
            $table->$fieldConfig($fieldName, $fieldLength)->nullable();
          } else {
            $table->$fieldConfig($fieldName)->nullable();
          }
        }
      });
    }
  }
}
