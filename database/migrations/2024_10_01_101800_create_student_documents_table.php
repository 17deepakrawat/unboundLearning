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
        Schema::create('student_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opportunities_id');
            $table->string('pendency')->nullable();
            $table->enum('status',[0,1,2,3])->default(0)->comment('0-InReview,1-approved,2-pendency,3-ReUploaded');
            $table->tinyInteger('added_by')->nullable();
            $table->tinyInteger('approved_by')->nullable();
            // $table->foreign('opportunities_id')->references('id')->on('opportunities')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_documents');
    }
};
