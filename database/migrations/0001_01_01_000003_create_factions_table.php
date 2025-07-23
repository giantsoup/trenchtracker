<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('lore')->nullable();
            $table->string('primary_color', 7)->nullable(); // Hex color code
            $table->string('secondary_color', 7)->nullable(); // Hex color code
            $table->string('icon')->nullable(); // Icon class or file name
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Indexes for common queries
            $table->index('is_active'); // For filtering active factions
            $table->index('sort_order'); // For ordering factions in lists
            $table->index(['is_active', 'sort_order']); // For combined active + ordered queries
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factions');
    }
};
