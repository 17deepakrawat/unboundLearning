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
    Schema::create('scheme_fee_structure', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('scheme_id');
      $table->unsignedBigInteger('fee_structure_id');
      $table->timestamps();

      $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('cascade');
      $table->foreign('fee_structure_id')->references('id')->on('fee_structures')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('scheme_fee_structure');
  }
};
