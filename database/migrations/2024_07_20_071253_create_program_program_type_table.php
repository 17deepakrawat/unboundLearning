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
    Schema::create('program_program_type', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('program_id');
      $table->unsignedBigInteger('program_type_id');
      $table->timestamps();

      $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('program_type_id')->references('id')->on('program_types')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('program_program_type');
  }
};
