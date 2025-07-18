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
    Schema::table('specialization_assign_vertical', function (Blueprint $table) {
      $table->unsignedBigInteger('specialization_id');
      $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('specialization_assign_vertical', function (Blueprint $table) {
      //
    });
  }
};
