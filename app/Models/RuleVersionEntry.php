<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RuleVersionEntry extends Model
{
    protected $fillable = [
        'rule_id',
        'rule_version_id',
        'content_override',
        'status',
    ];

    protected $casts = [
        'content_override' => 'array',
        'rule_id' => 'integer',
        'rule_version_id' => 'integer',
    ];

    /**
     * Relationship: A rule version entry belongs to a rule
     */
    public function rule(): BelongsTo
    {
        return $this->belongsTo(Rule::class);
    }

    /**
     * Relationship: A rule version entry belongs to a rule version
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
        return $query->join('rule_versions', 'rule_version_entries.rule_version_id', '=', 'rule_versions.id')
            ->orderBy('rule_versions.release_date', 'desc')
            ->orderBy('rule_versions.version_number', 'desc')
            ->select('rule_version_entries.*');
    }

    /**
     * Scope: Get active entries ordered by version
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->active()->ordered();
    }

    /**
     * Scope: Get entries for a specific rule
     */
    public function scopeForRule(Builder $query, $ruleId): Builder
    {
        return $query->where('rule_id', $ruleId);
    }

    /**
     * Scope: Get entries for a specific rule version
     */
    public function scopeForVersion(Builder $query, $versionId): Builder
    {
        return $query->where('rule_version_id', $versionId);
    }

    /**
     * Check if this is an active entry
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if this is a superseded entry
     */
    public function isSuperseded(): bool
    {
        return $this->status === 'superseded';
    }

    /**
     * Check if this is an errata entry
     */
    public function isErrata(): bool
    {
        return $this->status === 'errata';
    }

    /**
     * Check if this entry has content overrides
     */
    public function hasContentOverride(): bool
    {
        return ! empty($this->content_override);
    }

    /**
     * Get the display name for this entry
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->rule->title.' ('.$this->ruleVersion->version_number.')';
    }

    /**
     * Get the overridden content or fall back to original
     */
    public function getEffectiveContent(): string
    {
        if ($this->hasContentOverride() && isset($this->content_override['content_markdown'])) {
            return $this->content_override['content_markdown'];
        }

        return $this->rule->content_markdown;
    }

    /**
     * Get the overridden structured data or fall back to original
     */
    public function getEffectiveStructuredData(): ?array
    {
        if ($this->hasContentOverride() && isset($this->content_override['structured_data'])) {
            return $this->content_override['structured_data'];
        }

        return $this->rule->structured_data;
    }

    /**
     * Get the overridden title or fall back to original
     */
    public function getEffectiveTitle(): string
    {
        if ($this->hasContentOverride() && isset($this->content_override['title'])) {
            return $this->content_override['title'];
        }

        return $this->rule->title;
    }

    /**
     * Get a specific override field or fall back to original rule field
     */
    public function getOverrideField(string $field)
    {
        if ($this->hasContentOverride() && isset($this->content_override[$field])) {
            return $this->content_override[$field];
        }

        return $this->rule->{$field} ?? null;
    }
}
