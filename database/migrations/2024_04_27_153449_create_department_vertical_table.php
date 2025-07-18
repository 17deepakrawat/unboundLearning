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
    Schema::create('department_vertical', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('department_id');
      $table->unsignedBigInteger('vertical_id');
      $table->boolean('for_website')->default(true);
      $table->boolean('is_active')->default(true);
      $table->json('description')->nullable(true);
      $table->timestamps();

      $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('department_vertical');
  }
};
