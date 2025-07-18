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
    Schema::create('constant_fees', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('vertical_id');
      $table->unsignedBigInteger('scheme_id');
      $table->unsignedBigInteger('fee_structure_id');
      $table->unsignedBigInteger('specialization_id');
      $table->unsignedBigInteger('admission_type_id')->nullable();
      $table->string('fee_type');
      $table->integer('duration');
      $table->integer('fee');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('constant_fees');
  }
};
