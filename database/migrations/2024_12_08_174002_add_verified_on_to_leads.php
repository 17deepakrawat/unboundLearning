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
      $table->dateTime('phone_verified_on')->nullable(true);
      $table->dateTime('email_verified_on')->nullable(true);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('leads', function (Blueprint $table) {
      $table->dropColumn('phone_verified_on');
      $table->dropColumn('email_verified_on');
    });
  }
};
