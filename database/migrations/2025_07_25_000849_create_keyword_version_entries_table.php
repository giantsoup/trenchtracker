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
        Schema::create('keyword_version_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keyword_id')->constrained()->cascadeOnDelete();
            $table->foreignId('rule_version_id')->constrained()->cascadeOnDelete();
            $table->json('content_override')->nullable();
            $table->enum('status', ['active', 'superseded', 'errata']);
            $table->timestamps();

            // Unique constraint
            $table->unique(['keyword_id', 'rule_version_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyword_version_entries');
    }
};
