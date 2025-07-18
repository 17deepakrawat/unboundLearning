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
    Schema::create('specialization_assign_vertical', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('vertical_id');
      $table->unsignedBigInteger('admission_type_id');
      $table->string('required_eligibility_criteria_id');
      $table->string('optional_eligibility_criteria_id');
      $table->string('admission_duration');
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('admission_type_id')->references('id')->on('admission_types')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('specialization_assign_vertical');
  }
};
