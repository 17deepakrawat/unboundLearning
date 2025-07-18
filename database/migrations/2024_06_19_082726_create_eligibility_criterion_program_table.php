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
    Schema::create('eligibility_criterion_program', function (Blueprint $table) {
      $table->unsignedBigInteger('eligibility_criterion_id');
      $table->unsignedBigInteger('program_id');
      $table->boolean('is_required')->default(true);

      $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('eligibility_criterion_id')->references('id')->on('eligibility_criteria')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('eligibility_criterion_program');
  }
};
