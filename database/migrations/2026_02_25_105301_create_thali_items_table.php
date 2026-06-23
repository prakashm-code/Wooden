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
        Schema::create('thali_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thali_id')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->integer('quantity'); // 4 roti, 1 dal
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('thali_id')->references('id')->on('thalis')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thali_items');
    }
};
