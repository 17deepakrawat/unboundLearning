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
        Schema::create('student_status_vertical', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_status_id');
            $table->unsignedBigInteger('vertical_id');

            $table->foreign('student_status_id')->references('id')->on('student_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_status_vertical');
    }
};
