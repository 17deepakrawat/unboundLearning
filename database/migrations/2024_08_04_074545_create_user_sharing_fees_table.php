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
    Schema::create('user_sharing_fees', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_sharing_id');
      $table->unsignedBigInteger('scheme_id');
      $table->unsignedBigInteger('specialization_id');
      $table->unsignedBigInteger('fee_structure_id');
      $table->string('fee_type');
      $table->integer('duration');
      $table->integer('fee');
      $table->timestamps();

      $table->foreign('user_sharing_id')->references('id')->on('user_sharings')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('fee_structure_id')->references('id')->on('fee_structures')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('user_sharing_fees');
  }
};
