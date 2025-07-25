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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Hellblade", "Tartarus Claws"
            $table->string('type'); // "melee_weapon", "ranged_weapon", "armor"
            $table->foreignId('category_id')->constrained('equipment_categories');
            $table->json('base_cost'); // {"ducats": 15, "glory_points": 1}
            $table->json('stats'); // Weapon stats, armor values, etc.
            $table->longText('lore_markdown')->nullable(); // Rich description
            $table->timestamps();

            // Index for performance
            $table->index(['category_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
