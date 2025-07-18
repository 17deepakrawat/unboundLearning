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
    Schema::create('admission_sessions', function (Blueprint $table) {
      $table->id();
      $table->integer('month');
      $table->integer('year');
      $table->unsignedBigInteger('vertical_id');
      $table->boolean('is_active')->default(true);
      $table->boolean('current')->default(false);
      $table->timestamps();

      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('admission_sessions');
  }
};
