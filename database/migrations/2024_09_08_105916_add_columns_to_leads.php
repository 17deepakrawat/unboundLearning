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
      $table->unsignedMediumInteger('country_id')->nullable();
      $table->unsignedMediumInteger('state_id')->nullable();
      $table->unsignedMediumInteger('city_id')->nullable();
      $table->text('address')->nullable();
      $table->string('zip_code')->nullable();
      $table->string('source_campaign')->nullable();
      $table->string('source_medium')->nullable();
      $table->string('ad_group')->nullable();
      $table->string('ad_name')->nullable();
      $table->text('website')->nullable();
      $table->string('origin')->nullable();
      $table->string('mobile')->nullable();
      $table->string('alternate_email')->nullable();

      $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
      $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
      $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('leads', function (Blueprint $table) {
      //
    });
  }
};
