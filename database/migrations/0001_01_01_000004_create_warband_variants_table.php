
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warband_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faction_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->text('special_rules')->nullable();
            $table->string('icon')->nullable(); // Icon class or file name
            $table->json('starting_resources')->nullable(); // Starting ducats, special equipment, etc.
            $table->json('unit_restrictions')->nullable(); // Max/min units of certain types
            $table->json('equipment_restrictions')->nullable(); // Banned/allowed equipment
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['faction_id', 'slug']);
            $table->index(['faction_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warband_variants');
    }
};
