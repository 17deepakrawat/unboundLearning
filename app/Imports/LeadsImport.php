<?php

namespace App\Imports;

use App\Models\Academics\program;
use App\Models\Academics\specialization;
use App\Models\Leads\Lead;
use App\Models\Settings\Components\city;
use App\Models\Settings\Components\country;
use App\Models\Settings\Components\state;
use App\Models\Settings\Leads\source;
use App\Models\Settings\Leads\stage;
use App\Models\Settings\Leads\subsource;
use App\Models\Settings\Leads\substage;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LeadsImport implements ToCollection, WithHeadingRow
{
  /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */

  public $statuses = [];

  public function collection(Collection $rows)
  {
    foreach ($rows as $index => $row) {
      // Validate row data
      $validator = Validator::make($row->toArray(), [
        'firstname' => 'required|string',
        'lastname' => 'string',
        'email' => 'required|email',
        'alternateemail' => 'email',
        'countrycode' => 'required|integer',
        'phone' => 'required|integer',
        'alternatemobile' => 'string',
        'dob' => 'string',
        'source' => 'required|string',
        'subsource' => 'required|string',
        'program' => 'string',
        'specialization' => 'string',
        'country' => 'string',
        'state' => 'string',
        'city' => 'string',
        'address' => 'string',
        'zipcode' => 'integer',
        'campaign' => 'string',
        'sourcemedium' => 'string',
        'adname' => 'string',
        'adgroup' => 'string',
        'stage' => 'required|string',
        'substage' => 'required|string',
        'password' => 'required|string',
        'owneremail' => 'required|email',
      ]);

      if ($validator->fails()) {
        $this->statuses[] = [
          'row'    => $index + 1, // Row number
          'status' => 'Failed',
          'error'  => $validator->errors()->first(),
        ];
        continue;
      }

      // Checks
      $lead = Lead::where('email', $row['email'])->first();
      if ($lead) {
        $this->statuses[] = [
          'row'    => $index + 1,
          'status' => 'Failed',
          'error'  => 'Lead with this email already exists!',
        ];
        continue;
      }

      $lead = Lead::where('phone', $row['phone'])
        ->where('country_code', $row['countrycode'])
        ->first();
      if ($lead) {
        $this->statuses[] = [
          'row'    => $index + 1,
          'status' => 'Failed',
          'error'  => 'Lead with this phone number already exists!',
        ];
        continue;
      }

      // Get Owner
      $owner = User::where('email', $row['owneremail'])->first();
      if (!$owner) {
        $this->statuses[] = [
          'row'    => $index + 1,
          'status' => 'Failed',
          'error'  => 'Owner not exists!',
        ];
        continue;
      }

      // Get program, source, subsource
      $source = source::where('name', $row['source'])->first();
      if (!$source) {
        $source = source::create(['name' => $row['source']]);
      }

      $subSource = subsource::where('name', $row['subsource'])->where('source_id', $source->id)->first();
      if (!$subSource) {
        $subSource = subsource::create(['source_id' => $source->id, 'name' => $row['subsource']]);
      }

      $stage = stage::where('name', $row['stage'])->first();
      if (!$stage) {
        $this->statuses[] = [
          'row'    => $index + 1,
          'status' => 'Failed',
          'error'  => 'stage not exists!',
        ];
        continue;
      }

      $specialization = null;
      $subStage = substage::where('stage_id', $stage->id)->where('name', $row['substage'])->first();
      if (!$subStage) {
        $this->statuses[] = [
          'row'    => $index + 1,
          'status' => 'Failed',
          'error'  => 'substage not exists!',
        ];
        continue;
      }

      if (!empty($row['program'])) {
        $program = program::where('name', $row['program'])->first();
        if (!empty($row['specialization']) && $program) {
          $specialization = specialization::where('program_id', $program->id)->where('name', $row['specialization'])->first();
        }
      }

      // country, state, city
      $country = country::where('name', $row['country'])->first();
      $state = state::where('name', $row['state'])->first();
      $city = city::where('name', $row['city'])->first();

      $dob = !empty($row['dob']) && date("Y-m-d", strtotime($row['dob'])) != '1970-01-01' ? date("Y-m-d", strtotime($row['dob'])) : null;

      // Insert valid data into the database
      Lead::create([
        'first_name' => $row['firstname'],
        'last_name' => $row['lastname'] ?? null,
        'email' => $row['email'],
        'alternate_email' => $row['alternateemail'] ?? null,
        'country_code' => $row['countrycode'],
        'phone' => $row['phone'],
        'mobile' => $row['alternatemobile'] ?? null,
        'dob' => $dob,
        'program_id' => $program ? $program->id : null,
        'specialization_id' => $specialization ? $specialization->id : null,
        'country_id' => $country ? $country->id : null,
        'state_id' => $state ? $state->id : null,
        'city_id' => $city ? $city->id : null,
        'address' => $row['address'] ?? null,
        'zip_code' => $row['zipcode'] ?? null,
        'source_campaign' => $row['campaign'] ?? null,
        'source_medium' => $row['sourcemedium'] ?? null,
        'ad_name' => $row['adname'] ?? null,
        'ad_group' => $row['adgroup'] ?? null,
        'user_id' => $owner->id,
        'stage_id' => $stage->id,
        'sub_stage_id' => $subStage->id,
        'source_id' => $source->id,
        'sub_source_id' => $subSource->id,
        'password' => Hash::make($row['password']),
      ]);

      $this->statuses[] = [
        'row'    => $index + 1,
        'status' => 'Success',
        'error'  => null,
      ];
    }
  }
}
