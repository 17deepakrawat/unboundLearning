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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vertical_id');
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('scheme_id');
            $table->unsignedBigInteger('syllabus_id');
            $table->string('name');
            $table->string('chapter')->nullable();
            $table->string('units')->nullable();
            $table->string('topics')->nullable();
            $table->string('file_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
      
            $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict');
            $table->foreign('scheme_id')->references('id')->on('schemes')->onDelete('restrict');
            $table->foreign('syllabus_id')->references('id')->on('syllabi')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
