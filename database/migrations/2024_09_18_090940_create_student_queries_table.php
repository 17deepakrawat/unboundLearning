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
        Schema::create('student_queries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('lead_id');
            $table->unsignedBigInteger('query_type_id');
            $table->unsignedBigInteger('query_sub_type_id');
            $table->string('attachment');
            $table->longText('description');
            $table->boolean('status')->default(false);
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('restrict');
            $table->foreign('query_type_id')->references('id')->on('query_types')->onDelete('restrict');
            $table->foreign('query_sub_type_id')->references('id')->on('query_sub_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_queries');
    }
};
