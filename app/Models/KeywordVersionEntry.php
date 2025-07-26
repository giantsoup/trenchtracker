<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeywordVersionEntry extends Model
{
    protected $fillable = [
        'keyword_id',
        'rule_version_id',
        'content_override',
        'status',
    ];

    protected $casts = [
        'content_override' => 'array',
        'keyword_id' => 'integer',
        'rule_version_id' => 'integer',
    ];

    /**
     * Relationship: A keyword version entry belongs to a keyword
     */
    public function keyword(): BelongsTo
    {
        return $this->belongsTo(Keyword::class);
    }

    /**
     * Relationship: A keyword version entry belongs to a rule version
     */
    public function ruleVersion(): BelongsTo
    {
        return $this->belongsTo(RuleVersion::class);
    }

    /**
     * Scope: Get only active entries
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: Get only superseded entries
     */
    public function scopeSuperseded(Builder $query): Builder
    {
        return $query->where('status', 'superseded');
    }

    /**
     * Scope: Get only errata entries
     */
    public function scopeErrata(Builder $query): Builder
    {
        return $query->where('status', 'errata');
    }

    /**
     * Scope: Order entries by rule version release date (newest first)
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->join('rule_versions', 'keyword_version_entries.rule_version_id', '=', 'rule_versions.id')
            ->orderBy('rule_versions.release_date', 'desc')
            ->orderBy('rule_versions.version_number', 'desc')
            ->select('keyword_version_entries.*');
    }

    /**
     * Scope: Get active entries ordered by version
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->active()->ordered();
    }

    /**
     * Scope: Get entries for a specific keyword
     */
    public function scopeForKeyword(Builder $query, $keywordId): Builder
    {
        return $query->where('keyword_id', $keywordId);
    }

    /**
     * Scope: Get entries for a specific rule version
     */
    public function scopeForVersion(Builder $query, $versionId): Builder
    {
        return $query->where('rule_version_id', $versionId);
    }

    /**
     * Scope: Get entries that have content overrides
     */
    public function scopeWithOverrides(Builder $query): Builder
    {
        return $query->whereNotNull('content_override')
            ->where('content_override', '!=', '[]')
            ->where('content_override', '!=', '{}');
    }

    /**
     * Check if this version entry is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Get the display name for this entry
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->keyword->name.' ('.$this->ruleVersion->version_number.')';
    }

    /**
     * Check if this version entry is superseded
     */
    public function isSuperseded(): bool
    {
        return $this->status === 'superseded';
    }

    /**
     * Check if this version entry is errata
     */
    public function isErrata(): bool
    {
        return $this->status === 'errata';
    }

    /**
     * Get the effective rule text for this version
     */
    public function getEffectiveRuleText(): string
    {
        if ($this->content_override && isset($this->content_override['rule_text_markdown'])) {
            return $this->content_override['rule_text_markdown'];
        }

        return $this->keyword->rule_text_markdown;
    }

    /**
     * Get the effective description for this version
     */
    public function getEffectiveDescription(): string
    {
        if ($this->content_override && isset($this->content_override['description_markdown'])) {
            return $this->content_override['description_markdown'];
        }

        return $this->keyword->description_markdown;
    }

    /**
     * Get the effective examples for this version
     */
    public function getEffectiveExamples(): ?array
    {
        if ($this->content_override && isset($this->content_override['examples'])) {
            return $this->content_override['examples'];
        }

        return $this->keyword->examples;
    }

    /**
     * Check if this version entry has any content overrides
     */
    public function hasContentOverrides(): bool
    {
        return ! empty($this->content_override);
    }

    /**
     * Get a summary of what was changed in this version
     */
    public function getChangesSummary(): array
    {
        $changes = [];

        if (! $this->hasContentOverrides()) {
            return $changes;
        }

        if (isset($this->content_override['rule_text_markdown'])) {
            $changes[] = 'Rule text updated';
        }

        if (isset($this->content_override['description_markdown'])) {
            $changes[] = 'Description updated';
        }

        if (isset($this->content_override['examples'])) {
            $changes[] = 'Examples updated';
        }

        return $changes;
    }
}
