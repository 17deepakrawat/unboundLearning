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
        Schema::table('notes', function (Blueprint $table) {
            $table->renameColumn('chapter', 'chapters_id');
            $table->renameColumn('units', 'units_id');
            $table->renameColumn('topics', 'topics_id');
            $table->unsignedBigInteger('chapters_id')->change()->nullable();
            $table->unsignedBigInteger('units_id')->change()->nullable();
            $table->unsignedBigInteger('topics_id')->change()->nullable();
            $table->foreign('chapters_id')->references('id')->on('chapters')->onDelete('restrict');
            $table->foreign('units_id')->references('id')->on('units')->onDelete('restrict');
            $table->foreign('topics_id')->references('id')->on('topics')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
