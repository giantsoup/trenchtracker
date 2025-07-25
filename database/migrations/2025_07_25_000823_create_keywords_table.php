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
        Schema::create('keywords', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "BLAST", "HEAVY", "RISKY"
            $table->foreignId('keyword_type_id')->constrained()->cascadeOnDelete();
            $table->longText('description_markdown');
            $table->longText('rule_text_markdown');
            $table->json('examples')->nullable(); // Usage examples
            $table->timestamps();

            // Indexes and constraints
            $table->index(['keyword_type_id', 'name']);
            $table->unique(['name', 'keyword_type_id']); // Same keyword can exist in different types
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keywords');
    }
};
