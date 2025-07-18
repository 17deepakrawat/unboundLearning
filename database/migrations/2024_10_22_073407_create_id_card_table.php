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
        Schema::create('id_cards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_active')->default(0);
            $table->longText('design');
            $table->string('name');
            $table->unsignedBigInteger('vertical_id');
            $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('id_cards');
    }
};
