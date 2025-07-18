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
    Schema::create('syllabi', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('vertical_id');
      $table->unsignedBigInteger('scheme_id');
      $table->unsignedBigInteger('specialization_id');
      $table->integer('duration');
      $table->string('name');
      $table->string('code');
      $table->string('paper_type');
      $table->integer('credit');
      $table->integer('minimum_marks');
      $table->integer('maximum_marks');
      $table->boolean('is_active')->default(true);
      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict');
      $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('restrict');
      $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('syllabi');
  }
};
