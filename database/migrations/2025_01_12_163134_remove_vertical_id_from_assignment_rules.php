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
    Schema::table('assignment_rules', function (Blueprint $table) {
      $table->dropForeign(['vertical_id']);
      $table->dropColumn('vertical_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('assignment_rules', function (Blueprint $table) {
      //
    });
  }
};
