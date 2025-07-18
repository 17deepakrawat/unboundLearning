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
    Schema::create('program_type_department', function (Blueprint $table) {
      $table->unsignedBigInteger('program_type_id');
      $table->unsignedBigInteger('department_id');
      $table->boolean('is_active')->default(true);

      $table->foreign('program_type_id')->references('id')->on('program_types')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('program_type_department');
  }
};
