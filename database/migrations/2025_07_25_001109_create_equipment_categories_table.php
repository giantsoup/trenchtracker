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
        Schema::create('equipment_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Ranged Weapons", "Rifles", "Melee Weapons"
            $table->string('slug')->unique();
            $table->foreignId('parent_id')->nullable()->constrained('equipment_categories');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Index for performance
            $table->index(['parent_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_categories');
    }
};
