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
      $table->string('source_campaign')->nullable();
      $table->string('source_medium')->nullable();
      $table->string('ad_group')->nullable();
      $table->string('ad_name')->nullable();
      $table->text('website')->nullable();
      $table->string('origin')->nullable();
      $table->string('student_id')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('opportunities', function (Blueprint $table) {
      //
    });
  }
};
