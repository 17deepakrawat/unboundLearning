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
    Schema::create('sub_sources', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->unsignedBigInteger('source_id');
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('sub_sources');
  }
};
