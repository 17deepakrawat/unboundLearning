<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::table('opportunities', function (Blueprint $table) {
      $table->string('name')->after('lead_id')->nullable();
      $table->string('email')->after('name')->nullable();
      $table->string('country_code')->after('email')->nullable();
      $table->string('phone')->after('country_code')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('opportunities', function (Blueprint $table) {
      $table->dropColumn('name');
      $table->dropColumn('email');
      $table->dropColumn('country_code');
      $table->dropColumn('phone');
    });
  }
};
