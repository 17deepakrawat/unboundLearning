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
    Schema::create('leads', function (Blueprint $table) {
      $table->id();
      $table->string('first_name')->nullable();
      $table->string('last_name')->nullable();
      $table->string('email')->nullable();
      $table->string('phone')->nullable();
      $table->date('date_of_birth')->nullable();
      $table->text('avatar')->nullable();
      $table->unsignedBigInteger('source_id');
      $table->unsignedBigInteger('sub_source_id')->nullable();
      $table->timestamps();

      $table->foreign('source_id')->references('id')->on('sources')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('sub_source_id')->references('id')->on('sub_sources')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('leads');
  }
};
