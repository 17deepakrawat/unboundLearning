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
    Schema::create('program_department', function (Blueprint $table) {
      $table->unsignedBigInteger('program_id');
      $table->unsignedBigInteger('department_id');

      $table->foreign('program_id')->references('id')->on('programs')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('program_department');
  }
};
