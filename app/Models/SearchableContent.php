<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SearchableContent extends Model
{
    protected $table = 'searchable_content';

    protected $fillable = [
        'searchable_type',
        'searchable_id',
        'title',
        'content_text',
        'keywords',
        'version_tags',
        'content_type',
        'rule_phase_id',
    ];

    protected $casts = [
        'keywords' => 'array',
        'version_tags' => 'array',
        'rule_phase_id' => 'integer',
    ];

    /**
     * Get the searchable model that this content represents.
     */
    public function searchable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the rule phase this content belongs to.
     */
    public function rulePhase(): BelongsTo
    {
        return $this->belongsTo(RulePhase::class);
    }

    /**
     * Scope: Filter by content type
     */
    public function scopeOfType(Builder $query, string $contentType): Builder
    {
        return $query->where('content_type', $contentType);
    }

    /**
     * Scope: Filter by rule phase
     */
    public function scopeForPhase(Builder $query, int $phaseId): Builder
    {
        return $query->where('rule_phase_id', $phaseId);
    }

    /**
     * Scope: Search by title and content
     */
    public function scopeSearch(Builder $query, string $searchTerm): Builder
    {
        // Use full-text search for databases that support it
        if (config('database.default') !== 'sqlite') {
            return $query->whereFullText(['title', 'content_text'], $searchTerm);
        }

        // Fallback to LIKE search for SQLite
        $terms = array_filter(explode(' ', $searchTerm));

        return $query->where(function ($subQuery) use ($terms) {
            foreach ($terms as $term) {
                $subQuery->where(function ($termQuery) use ($term) {
                    $termQuery->where('title', 'LIKE', "%{$term}%")
                        ->orWhere('content_text', 'LIKE', "%{$term}%");
                });
            }
        });
    }

    /**
     * Scope: Filter by keywords
     */
    public function scopeWithKeyword(Builder $query, string $keyword): Builder
    {
        return $query->whereJsonContains('keywords', $keyword);
    }

    /**
     * Scope: Filter by version tags
     */
    public function scopeForVersion(Builder $query, string $version): Builder
    {
        return $query->whereJsonContains('version_tags', $version);
    }
}
