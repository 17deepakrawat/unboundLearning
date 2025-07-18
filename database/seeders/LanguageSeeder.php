<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Components\Language;

class LanguageSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Language::create(['name' => 'English', 'locale' => 'English']);
    Language::create(['name' => 'Hindi', 'locale' => 'हिंदी']);
    Language::create(['name' => 'Telugu', 'locale' => 'తెలుగు']);
    Language::create(['name' => 'Tamil', 'locale' => 'தமிழ்']);
    Language::create(['name' => 'Kannada', 'locale' => 'ಕನ್ನಡ']);
    Language::create(['name' => 'Malayalam', 'locale' => 'മലയാളം']);
    Language::create(['name' => 'Urdu', 'locale' => 'اُردُو']);
    Language::create(['name' => 'Gujarati', 'locale' => 'ગુજરાતી']);
    Language::create(['name' => 'Marathi', 'locale' => 'मराठी']);
  }
}
