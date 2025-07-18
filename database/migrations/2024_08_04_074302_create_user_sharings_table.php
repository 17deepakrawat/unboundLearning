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
    Schema::create('user_sharings', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('vertical_id');
      $table->unsignedBigInteger('admission_session_id');
      $table->date('start_date');
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('admission_session_id')->references('id')->on('admission_sessions')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('user_sharings');
  }
};
