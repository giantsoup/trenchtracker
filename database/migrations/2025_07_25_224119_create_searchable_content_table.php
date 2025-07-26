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
        Schema::create('searchable_content', function (Blueprint $table) {
            $table->id();
            $table->morphs('searchable'); // What content this represents
            $table->string('title');
            $table->longText('content_text'); // Flattened searchable text
            $table->json('keywords'); // Array of associated keywords
            $table->json('version_tags'); // Which versions this applies to
            $table->string('content_type'); // "rule", "keyword", "equipment"
            $table->foreignId('rule_phase_id')->nullable()->constrained();
            $table->timestamps();

            // Indexes for search performance
            $table->index(['content_type', 'rule_phase_id']);
            $table->index('title');
            $table->index('content_type');

            // Full-text search indexes (only for databases that support them)
            if (config('database.default') !== 'sqlite') {
                $table->fullText(['title', 'content_text']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('searchable_content');
    }
};
