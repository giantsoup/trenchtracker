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
        Schema::create('rule_phases', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Movement", "Shooting", "Melee"
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();

            // Index for performance
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_phases');
    }
};
