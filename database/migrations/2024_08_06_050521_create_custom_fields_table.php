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
    Schema::create('custom_fields', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->boolean('mandatory')->default(false);
      $table->string('schema')->unique();
      $table->string('validation')->nullable();
      $table->string('type');
      $table->json('options')->nullable();
      $table->unsignedBigInteger('dependent')->nullable();
      $table->boolean('is_multiple')->default(false);
      $table->boolean('is_intl_phone')->default(false);
      $table->enum('sub_type', ['Radio', 'Check Box'])->nullable();
      $table->string('extension')->nullable();
      $table->enum('use_for', ['lead']);
      $table->integer('size')->nullable();
      $table->boolean('is_active')->default(true);
      $table->boolean('is_core_field')->default(false);
      $table->timestamps();

      $table->foreign('dependent')->references('id')->on('custom_fields')->onDelete('restrict')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('custom_fields');
  }
};
