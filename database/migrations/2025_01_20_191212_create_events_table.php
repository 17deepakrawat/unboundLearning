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
    Schema::create('events', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('event_category_id');
      $table->unsignedBigInteger('specialization_id');
      $table->string('title');
      $table->text('description')->nullable();
      $table->tinyText('url')->nullable();

      $table->date('start_date');
      $table->date('end_date');
      $table->time('start_time')->nullable();
      $table->time('end_time')->nullable();
      $table->boolean('all_day')->default(false);

      // Fields for recurring events
      $table->boolean('recurring')->default(false);
      $table->string('recurrence_type')->nullable(); // 'daily', 'weekly', 'monthly', etc.
      $table->json('recurrence_days')->nullable(); // JSON: Days of the week for recurrence (e.g., [1, 3, 5])

      $table->boolean('is_active')->default(true);

      $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
      $table->foreign('event_category_id')->references('id')->on('event_categories')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('events');
  }
};
