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
    Schema::create('programs', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->string('short_name')->unique();
      $table->string('slug')->unique()->index('slug');
      $table->string('duration')->nullable();
      $table->boolean('for_website')->defaultValue(true);
      $table->boolean('is_active')->default(true);
      $table->json('content')->nullable(true);
      $table->json('images')->nullable(true);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('programs');
  }
};
