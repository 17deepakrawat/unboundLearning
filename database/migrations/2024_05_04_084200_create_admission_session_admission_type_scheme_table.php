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
    Schema::create('admission_session_admission_type_scheme', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('admission_session_admission_type_id');
      $table->unsignedBigInteger('scheme_id');
      $table->date('start_date');

      $table->foreign('admission_session_admission_type_id', 'adm_session_adm_type_id')->references('id')->on('admission_session_admission_type')->onDelete('cascade');
      $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('admission_session_admission_type_scheme');
  }
};
