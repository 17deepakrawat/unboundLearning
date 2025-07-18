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
        Schema::table('assignment_rules', function (Blueprint $table) {
            $table->unsignedBigInteger('vertical_id');
            $table->foreign('vertical_id')->references('id')->on('verticals')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignment_rules', function (Blueprint $table) {
            $table->dropColumn('vertical_id');
        });
    }
};
