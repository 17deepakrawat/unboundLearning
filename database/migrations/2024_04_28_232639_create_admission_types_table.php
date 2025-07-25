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
    Schema::create('admission_types', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('vertical_id');
      $table->string('name')->index('name');
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->foreign('vertical_id')->references('id')->on('verticals')->onUpdate('cascade')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('admission_types');
  }
};
