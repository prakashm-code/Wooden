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
        Schema::table('plywoods', function (Blueprint $table) {
            $table->string('unit')->nullable();
        });
        Schema::table('doors', function (Blueprint $table) {
            $table->string('unit')->nullable();
        });
        Schema::table('block_boards', function (Blueprint $table) {
            $table->string('unit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plywoods', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
        Schema::table('doors', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
        Schema::table('block_boards', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }
};
