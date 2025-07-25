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
    Schema::table('website_contents', function (Blueprint $table) {
      $table->json('asset')->nullable(true);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('website_contents', function (Blueprint $table) {
      $table->dropColumn('asset');
    });
  }
};
