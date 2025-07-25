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
        Schema::create('rule_version_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rule_id')->constrained()->cascadeOnDelete();
            $table->foreignId('rule_version_id')->constrained()->cascadeOnDelete();
            $table->json('content_override')->nullable(); // Only store differences
            $table->enum('status', ['active', 'superseded', 'errata']);
            $table->timestamps();

            // Indexes and constraints
            $table->index(['rule_id', 'status']);
            $table->unique(['rule_id', 'rule_version_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_version_entries');
    }
};
