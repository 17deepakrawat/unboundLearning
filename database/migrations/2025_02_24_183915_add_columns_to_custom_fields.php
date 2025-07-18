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
      $table->integer('max_selection')->nullable()->after('is_multiple');
      $table->text('pre_selected_options')->nullable()->after('max_selection');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('custom_fields', function (Blueprint $table) {
      $table->dropColumn('max_selection');
      $table->dropColumn('pre_selected_options');
    });
  }
};
