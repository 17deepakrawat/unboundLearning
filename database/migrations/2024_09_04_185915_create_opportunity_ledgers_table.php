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
    Schema::create('opportunity_ledgers', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('opportunity_id');
      $table->unsignedBigInteger('payment_id')->nullable();
      $table->unsignedBigInteger('wallet_transaction_id')->nullable();
      $table->enum('payment_type', ['Full', 'Semester', 'Annual']);
      $table->float('amount');
      $table->integer('duration')->nullable();
      $table->timestamps();

      $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade');
      $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
      $table->foreign('wallet_transaction_id')->references('id')->on('wallet_transactions')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('opportunity_ledgers');
  }
};
