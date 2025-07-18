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
    Schema::create('verticals', function (Blueprint $table) {
      $table->id();
      $table->string('name')->index('name');
      $table->string('slug')->index('slug')->unique('slug');
      $table->string('short_name')->index('short_name')->unique();
      $table->string('vertical_name')->index('vertical_name');
      $table->boolean('for_website')->defaultValue(true);
      $table->boolean('for_panel')->defaultValue(false);
      $table->string('sharing_type')->index('sharing_type')->nullable(true);
      $table->text('logo');
      $table->json('images')->nullable(true);
      $table->json('content')->nullable(true);
      $table->json('metadata')->nullable(true);
      $table->boolean('is_active')->default(true);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('verticals');
  }
};
