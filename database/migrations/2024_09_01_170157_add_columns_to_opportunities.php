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
    Schema::table('opportunities', function (Blueprint $table) {
      $table->unsignedBigInteger('admission_session_id')->nullable();
      $table->unsignedBigInteger('admission_type_id')->nullable();
      $table->unsignedBigInteger('application_owner')->nullable();
      $table->unsignedBigInteger('student_status_id')->nullable();
      $table->unsignedBigInteger('scheme_id')->nullable();
      $table->integer('admission_duration')->nullable();

      $table->foreign('admission_session_id')->references('id')->on('admission_sessions')->onDelete('restrict');
      $table->foreign('admission_type_id')->references('id')->on('admission_types')->onDelete('restrict');
      $table->foreign('application_owner')->references('id')->on('users')->onDelete('restrict');
      $table->foreign('student_status_id')->references('id')->on('student_statuses')->onDelete('restrict');
      $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('restrict');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('opportunities', function (Blueprint $table) {
      //
    });
  }
};
