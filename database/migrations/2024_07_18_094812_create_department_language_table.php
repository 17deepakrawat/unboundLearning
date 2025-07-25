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
    Schema::create('department_language', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('department_id');
      $table->unsignedBigInteger('language_id');
      $table->json('content')->nullable(true);
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('department_language');
  }
};
