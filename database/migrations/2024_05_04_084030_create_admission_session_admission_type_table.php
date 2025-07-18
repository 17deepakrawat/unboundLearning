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
    Schema::create('admission_session_admission_type', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('admission_session_id');
      $table->unsignedBigInteger('admission_type_id');

      $table->foreign('admission_session_id')->references('id')->on('admission_sessions')->onDelete('cascade');
      $table->foreign('admission_type_id')->references('id')->on('admission_types')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('admission_session_admission_type');
  }
};
