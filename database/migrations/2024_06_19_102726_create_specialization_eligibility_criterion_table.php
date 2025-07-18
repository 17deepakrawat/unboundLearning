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
    Schema::create('specialization_eligibility_criterion', function (Blueprint $table) {
      $table->unsignedBigInteger('eligibility_criterion_id');
      $table->unsignedBigInteger('specialization_id');
      $table->boolean('is_required')->default(true);

      $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('eligibility_criterion_id', 'eligibility_id')->references('id')->on('eligibility_criteria')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('specialization_eligibility_criterion');
  }
};
