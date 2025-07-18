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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('dob');
            $table->text('bio')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('specialization_id');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};