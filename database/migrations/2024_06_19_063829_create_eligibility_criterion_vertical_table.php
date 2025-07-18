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
    Schema::create('eligibility_criterion_vertical', function (Blueprint $table) {
      $table->unsignedBigInteger('eligibility_criterion_id');
      $table->unsignedBigInteger('vertical_id');
      $table->boolean('is_active')->default(true);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('eligibility_criteria_vertical');
  }
};
