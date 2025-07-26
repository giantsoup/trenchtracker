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
        Schema::create('rule_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_rule_id')->constrained('rules')->cascadeOnDelete();
            $table->foreignId('target_rule_id')->constrained('rules')->cascadeOnDelete();
            $table->enum('reference_type', ['see_also', 'defines', 'modifies', 'example']);
            $table->text('context')->nullable(); // Additional context for the reference
            $table->timestamps();
            $table->index(['source_rule_id', 'reference_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_references');
    }
};
