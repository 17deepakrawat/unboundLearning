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
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->enum('type', ['online', 'offline']);
      $table->unsignedBigInteger('vertical_id')->nullable();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('opportunity_id')->nullable();
      $table->string('transaction_id');
      $table->date('transaction_date');
      $table->time('transaction_time');
      $table->string('beneficiary')->nullable();
      $table->string('mode');
      $table->float('amount');
      $table->string('source');
      $table->json('file');
      $table->boolean('for_wallet')->default(0);
      $table->tinyInteger('status')->default(0);
      $table->json('approved_by')->nullable();
      $table->json('meta')->nullable();
      $table->timestamps();

      $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
      $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payments');
  }
};
