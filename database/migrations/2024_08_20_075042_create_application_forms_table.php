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
    //Steps Table
    Schema::create('application_steps', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->tinyInteger('position');
      $table->boolean('is_active')->default(true);
      $table->unsignedBigInteger('vertical_id');
      $table->timestamps();
      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('application_steps');
    Schema::dropIfExists('application_fields');
  }
};
