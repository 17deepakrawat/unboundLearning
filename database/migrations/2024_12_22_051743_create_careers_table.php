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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('content')->nullable();
            $table->boolean('status')->default(true);
            $table->string('name');
            $table->tinyInteger('no_of_vacancy')->default(1);
            $table->longText('description');
            $table->string('city');
            $table->string('state');
            $table->enum('type',['full time','part time'])->default('full time');
            $table->string('shift_timing')->default('9 am - 5 pm Shift')->nullable();
            $table->string('salary')->default('Best in industry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career');
    }
};
