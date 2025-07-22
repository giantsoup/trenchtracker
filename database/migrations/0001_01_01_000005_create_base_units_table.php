
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
        Schema::create('base_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Faction relationship
            $table->foreignId('faction_id')->constrained()->onDelete('cascade');
            
            // Unit type and role
            $table->string('unit_type'); // e.g., 'trooper', 'elite', 'leader', 'specialist'
            $table->string('role')->nullable(); // e.g., 'assault', 'support', 'ranged', 'melee'
            
            // Core stats based on Trench Crusade rules
            $table->unsignedTinyInteger('movement'); // Movement characteristic in inches
            $table->unsignedTinyInteger('melee'); // Melee skill rating
            $table->unsignedTinyInteger('ranged'); // Ranged skill rating
            $table->unsignedTinyInteger('strength'); // Physical strength
            $table->unsignedTinyInteger('fortitude'); // Resilience/toughness
            $table->unsignedTinyInteger('leadership'); // Leadership value
            $table->unsignedTinyInteger('faith'); // Faith/willpower
            
            // Campaign system stats
            $table->unsignedSmallInteger('base_cost'); // Points cost to recruit
            $table->unsignedSmallInteger('upkeep_cost')->default(0); // Campaign upkeep cost
            $table->unsignedTinyInteger('max_wounds')->default(1); // Maximum wounds before out of action
            
            // Unit limits and availability
            $table->unsignedTinyInteger('min_warband_size')->default(0); // Minimum warband size to take this unit
            $table->unsignedTinyInteger('max_per_warband')->default(1); // Maximum of this unit type per warband
            $table->boolean('is_leader')->default(false); // Can this unit be a warband leader
            $table->boolean('is_unique')->default(false); // Unique character (only one per campaign)
            
            // Equipment and customization
            $table->json('starting_equipment')->nullable(); // Default equipment as array of item IDs
            $table->json('equipment_options')->nullable(); // Available equipment upgrades
            $table->json('stat_advancement_options')->nullable(); // Which stats can be improved
            
            // Special rules and keywords
            $table->json('special_rules')->nullable(); // Unit-specific special rules
            $table->text('lore_text')->nullable(); // Background/flavor text
            
            // Availability flags
            $table->boolean('is_active')->default(true); // Is this unit currently available
            $table->string('source_book')->nullable(); // Which rulebook/expansion this is from
            $table->string('version')->default('1.0'); // Rules version
            
            $table->timestamps();
            
            // Indexes for common queries
            $table->index(['faction_id', 'unit_type']);
            $table->index(['faction_id', 'is_active']);
            $table->index(['unit_type', 'is_active']);
            $table->index(['is_leader', 'is_active']);
            $table->index('base_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_units');
    }
};
