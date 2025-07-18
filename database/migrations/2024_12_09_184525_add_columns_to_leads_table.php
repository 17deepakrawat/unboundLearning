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
    Schema::table('leads', function (Blueprint $table) {
      $table->unsignedBigInteger('program_id')->nullable();
      $table->unsignedBigInteger('specialization_id')->nullable();
      $table->unsignedBigInteger('stage_id');
      $table->unsignedBigInteger('sub_stage_id')->nullable();
      $table->unsignedBigInteger('user_id');

      $table->foreign('program_id')->references('id')->on('programs')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('stage_id')->references('id')->on('stages')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('sub_stage_id')->references('id')->on('sub_stages')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('leads', function (Blueprint $table) {});
  }
};
