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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content_markdown'); // Base content in markdown
            $table->json('structured_data')->nullable(); // For calculations/logic
            $table->foreignId('rule_phase_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_searchable')->default(true);
            $table->timestamps();

            // Index for performance
            $table->index(['rule_phase_id', 'is_searchable']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
