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
        Schema::create('help_centers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('faq_content')->nullable();
            $table->json('slider_content')->nullable();
            $table->json('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_centers');
    }
};
