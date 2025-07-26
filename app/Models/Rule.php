<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Rule extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content_markdown',
        'structured_data',
        'rule_phase_id',
        'is_searchable',
    ];

    protected $casts = [
        'structured_data' => 'array',
        'is_searchable' => 'boolean',
        'rule_phase_id' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relationship: A rule belongs to a rule phase
     */
    public function rulePhase(): BelongsTo
    {
        return $this->belongsTo(RulePhase::class);
    }

    /**
     * Relationship: A rule has many version entries
     */
    public function versionEntries(): HasMany
    {
        return $this->hasMany(RuleVersionEntry::class);
    }

    /**
     * Polymorphic relationship: A rule can have many keywords
     */
    public function keywords(): MorphToMany
    {
        return $this->morphToMany(Keyword::class, 'keywordable');
    }

    /**
     * Self-referencing relationship: Rules this rule references
     */
    public function sourceReferences(): HasMany
    {
        return $this->hasMany(RuleReference::class, 'source_rule_id');
    }

    /**
     * Self-referencing relationship: Rules that reference this rule
     */
    public function targetReferences(): HasMany
    {
        return $this->hasMany(RuleReference::class, 'target_rule_id');
    }

    /**
     * Get rules that this rule references through the pivot table
     */
    public function referencedRules(): BelongsToMany
    {
        return $this->belongsToMany(Rule::class, 'rule_references', 'source_rule_id', 'target_rule_id')
            ->withPivot(['reference_type', 'context'])
            ->withTimestamps();
    }

    /**
     * Get rules that reference this rule through the pivot table
     */
    public function referencingRules(): BelongsToMany
    {
        return $this->belongsToMany(Rule::class, 'rule_references', 'target_rule_id', 'source_rule_id')
            ->withPivot(['reference_type', 'context'])
            ->withTimestamps();
    }

    /**
     * Scope: Get only searchable rules
     */
    public function scopeSearchable(Builder $query): Builder
    {
        return $query->where('is_searchable', true);
    }

    /**
     * Scope: Get rules by phase
     */
    public function scopeByPhase(Builder $query, $phaseId): Builder
    {
        return $query->where('rule_phase_id', $phaseId);
    }

    /**
     * Scope: Order rules by title
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('title');
    }

    /**
     * Scope: Get searchable rules ordered by title
     */
    public function scopeSearchableOrdered(Builder $query): Builder
    {
        return $query->searchable()->ordered();
    }

    /**
     * Scope: Search rules by title or content
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content_markdown', 'like', "%{$search}%");
        });
    }

    /**
     * Get active version entries for this rule
     */
    public function activeVersionEntries(): HasMany
    {
        return $this->versionEntries()->whereHas('ruleVersion', function ($query) {
            $query->where('is_active', true);
        });
    }

    /**
     * Get the latest version entry for this rule
     */
    public function latestVersionEntry()
    {
        return $this->versionEntries()
            ->whereHas('ruleVersion', function ($query) {
                $query->where('is_active', true);
            })
            ->latest()
            ->first();
    }

    /**
     * Get the display name for this rule
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->title;
    }

    /**
     * Get the current content (with version overrides applied)
     */
    public function getCurrentContent(): string
    {
        $latestEntry = $this->latestVersionEntry();

        if ($latestEntry && $latestEntry->content_override) {
            return $latestEntry->content_override['content_markdown'] ?? $this->content_markdown;
        }

        return $this->content_markdown;
    }

    /**
     * Get the current structured data (with version overrides applied)
     */
    public function getCurrentStructuredData(): ?array
    {
        $latestEntry = $this->latestVersionEntry();

        if ($latestEntry && $latestEntry->content_override) {
            return $latestEntry->content_override['structured_data'] ?? $this->structured_data;
        }

        return $this->structured_data;
    }

    /**
     * Check if this rule has structured data
     */
    public function hasStructuredData(): bool
    {
        return ! empty($this->getCurrentStructuredData());
    }

    /**
     * Check if this rule has any references
     */
    public function hasReferences(): bool
    {
        return $this->sourceReferences()->exists() || $this->targetReferences()->exists();
    }

    /**
     * Check if this rule has any keywords
     */
    public function hasKeywords(): bool
    {
        return $this->keywords()->exists();
    }

    /**
     * Get references by type
     */
    public function getReferencesByType(string $type): BelongsToMany
    {
        return $this->referencedRules()->wherePivot('reference_type', $type);
    }
}
