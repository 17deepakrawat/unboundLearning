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
    Schema::create('fee_structures', function (Blueprint $table) {
      $table->id();
      $table->string('name')->index('name');
      $table->unsignedBigInteger('vertical_id');
      $table->string('applicable_on');
      $table->boolean('has_sharing');
      $table->boolean('is_constant');
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('fee_structre');
  }
};
