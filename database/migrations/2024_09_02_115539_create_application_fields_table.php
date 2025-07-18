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
    Schema::create('application_fields', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('field_id');
      $table->unsignedBigInteger('step_id');
      $table->unsignedBigInteger('vertical_id');
      $table->integer('position');

      $table->foreign('field_id')->references('id')->on('custom_fields')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('step_id')->references('id')->on('application_steps')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('application_fields');
  }
};
