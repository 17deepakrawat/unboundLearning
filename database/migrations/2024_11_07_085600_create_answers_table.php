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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('questions_id');
            $table->longText('answer');
            $table->unsignedBigInteger('student_id');
            $table->foreign('questions_id')->references('id')->on('questions')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('student_id')->references('id')->on('leads')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
