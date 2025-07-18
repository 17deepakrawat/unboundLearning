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
    Schema::create('blogs', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('images')->nullable();
      $table->json('content')->nullable();
      $table->string('name');
      $table->string('slug');
      $table->boolean('is_active')->default(true);
      $table->enum('type', ['main', 'popular', 'case studies'])->nullable();
      $table->string('author');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('blogs');
  }
};
