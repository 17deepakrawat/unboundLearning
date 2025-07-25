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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('code');
            $table->string('syllabus_code');
            $table->unsignedBigInteger('syllabi_id');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('syllabi_id')->references('id')->on('syllabi')->onDelete('restrict');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
