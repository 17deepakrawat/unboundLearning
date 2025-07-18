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
    Schema::create('lead_custom_field', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('opportunity_id');
      $table->timestamps();
      $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('restrict')->onUpdate('restrict');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('lead_custom_field');
  }
};
