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
        Schema::create('rule_versions', function (Blueprint $table) {
            $table->id();
            $table->string('version_number'); // "1.6.3", "Errata 2024-01-15"
            $table->enum('type', ['base', 'errata', 'expansion']);
            $table->date('release_date');
            $table->boolean('is_active')->default(true);
            $table->string('pdf_path')->nullable(); // Path to downloadable PDF
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index(['type', 'is_active']);
            $table->unique('version_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_versions');
    }
};
