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
    Schema::table('custom_fields', function (Blueprint $table) {
      $table->enum('use_for', ['lead', 'application', 'opportunity', 'both'])->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('custom_fields', function (Blueprint $table) {
      //
    });
  }
};
