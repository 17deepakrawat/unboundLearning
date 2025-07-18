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
    Schema::create('application_rules', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('vertical_id');
      $table->string('name');
      $table->json('rule');
      $table->timestamps();

      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('application_rules');
  }
};
