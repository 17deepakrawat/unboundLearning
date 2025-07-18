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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vertical_id');
            $table->unsignedBigInteger('specialization_id');
            $table->integer('duration')->nullable();
            $table->string('title');
            $table->longText('description');
            $table->string('attachment');
            $table->string('type');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
