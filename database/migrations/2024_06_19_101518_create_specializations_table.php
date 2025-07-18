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
    Schema::create('specializations', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug');
      $table->unsignedBigInteger('department_id');
      $table->unsignedBigInteger('program_id');
      $table->unsignedBigInteger('program_type_id');
      $table->unsignedBigInteger('mode_id');
      $table->integer('min_duration');
      $table->integer('max_duration');
      $table->boolean('is_active')->default(true);
      $table->boolean('for_website')->default(false);
      $table->json('content')->nullable(true);
      $table->timestamps();

      $table->foreign('program_id')->references('id')->on('programs')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('department_id')->references('id')->on('departments')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('program_type_id')->references('id')->on('program_types')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('mode_id')->references('id')->on('modes')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('specializations');
  }
};
