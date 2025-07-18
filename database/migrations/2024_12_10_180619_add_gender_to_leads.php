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
    Schema::table('leads', function (Blueprint $table) {
      $table->string('gender')->nullable();
      $table->string('password')->nullable();
      $table->string('planning_to_start_in')->nullable();
      $table->string('for_whom')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('leads', function (Blueprint $table) {
      $table->dropColumn('gender');
      $table->dropColumn('password');
    });
  }
};
