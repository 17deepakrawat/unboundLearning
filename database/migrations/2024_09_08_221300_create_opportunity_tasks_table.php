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
    Schema::create('opportunity_tasks', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('opportunity_id');
      $table->unsignedBigInteger('task_id');
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('created_by');
      $table->timestamp('due_date')->nullable();
      $table->timestamp('completed_on')->nullable();
      $table->unsignedBigInteger('completed_by')->nullable();
      $table->text('remark')->nullable();
      $table->json('fields')->nullable();
      $table->string('priority');
      $table->timestamps();

      $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade');
      $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('completed_by')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('opportunity_tasks');
  }
};
