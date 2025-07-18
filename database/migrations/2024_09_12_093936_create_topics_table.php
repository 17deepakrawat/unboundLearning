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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('code');
            $table->unsignedBigInteger('units_id');
            $table->unsignedBigInteger('chapters_id');
            $table->foreign('units_id')->references('id')->on('units')->onDelete('restrict');
            $table->foreign('chapters_id')->references('id')->on('chapters')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
