<?php

namespace Database\Seeders;

use App\Models\Settings\Leads\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Source::create(['name' => 'Website']);
    Source::create(['name' => 'Social Media']);
    Source::create(['name' => 'Advertisement']);
    Source::create(['name' => 'Email Marketing']);
    Source::create(['name' => 'Direct Mail']);
    Source::create(['name' => 'Telemarketing']);
    Source::create(['name' => 'Paid Search']);
    Source::create(['name' => 'Referral']);
    Source::create(['name' => 'Other']);

    // Add Sub Sources
    $sources = ['Website', 'Social Media'];
    foreach ($sources as $source) {
      $source = Source::where('name', $source)->first();
      $subSources = ['Register Form Course Page', 'Course Details Page', 'Course Landing Page', 'Contact Us Page', 'About Us Page', 'FAQ Page'];
      foreach ($subSources as $subSource) {
        $source->subSources()->create(['name' => $subSource]);
      }
    }
  }
}
