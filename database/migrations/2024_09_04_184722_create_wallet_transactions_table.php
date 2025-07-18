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
    Schema::create('wallet_transactions', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('wallet_id');
      $table->unsignedBigInteger('opportunity_id')->nullable();
      $table->unsignedBigInteger('payment_id')->nullable();
      $table->enum('type', ['deposit', 'withdrawal']);
      $table->string('particular');
      $table->string('source');
      $table->float('amount');
      $table->timestamps();

      $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
      $table->foreign('opportunity_id')->references('id')->on('opportunities')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('wallet_transactions');
  }
};
