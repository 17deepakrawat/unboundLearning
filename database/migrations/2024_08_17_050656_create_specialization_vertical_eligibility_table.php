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
    Schema::create('specialization_vertical_eligibility', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('specialization_vertical_id');
      $table->unsignedBigInteger('required_eligibility_criteria_id');
      $table->unsignedBigInteger('optional_eligibility_criteria_id');
      $table->timestamps();
      $table->foreign('specialization_vertical_id', 'spl_vrtcl_id')->references('id')->on('specialization_assign_vertical')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('required_eligibility_criteria_id', 'req_eli_cri_id')->references('id')->on('eligibility_criteria')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('optional_eligibility_criteria_id', 'opt_eli_cri_id')->references('id')->on('eligibility_criteria')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('specialization_vertical_eligibility');
  }
};
