<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Keyword extends Model
{
    protected $fillable = [
        'name',
        'keyword_type_id',
        'description_markdown',
        'rule_text_markdown',
        'examples',
    ];

    protected $casts = [
        'examples' => 'array',
        'keyword_type_id' => 'integer',
    ];

    /**
     * Relationship: A keyword belongs to a keyword type
     */
    public function keywordType(): BelongsTo
    {
        return $this->belongsTo(KeywordType::class);
    }

    /**
     * Relationship: A keyword has many version entries
     */
    public function versionEntries(): HasMany
    {
        return $this->hasMany(KeywordVersionEntry::class);
    }

    /**
     * Get active version entries for this keyword
     */
    public function activeVersionEntries(): HasMany
    {
        return $this->versionEntries()->where('status', 'active');
    }

    /**
     * Get the latest version entry for this keyword
     */
    public function latestVersionEntry()
    {
        return $this->versionEntries()->latest()->first();
    }

    /**
     * Polymorphic relationship: Get all rules that use this keyword
     */
    public function rules(): MorphToMany
    {
        return $this->morphedByMany(Rule::class, 'keywordable');
    }

    /**
     * Polymorphic relationship: Get all equipment that use this keyword
     */
    public function equipment(): MorphToMany
    {
        return $this->morphedByMany(Equipment::class, 'keywordable');
    }

    /**
     * Polymorphic relationship: Get all base units that use this keyword
     */
    public function baseUnits(): MorphToMany
    {
        return $this->morphedByMany(BaseUnit::class, 'keywordable');
    }

    /**
     * Scope: Order keywords by name
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('name');
    }

    /**
     * Scope: Get keywords by type
     */
    public function scopeByType(Builder $query, $typeId): Builder
    {
        return $query->where('keyword_type_id', $typeId);
    }

    /**
     * Scope: Get global keywords
     */
    public function scopeGlobal(Builder $query): Builder
    {
        return $query->whereHas('keywordType', function ($query) {
            $query->where('scope', 'global');
        });
    }

    /**
     * Scope: Get faction-specific keywords
     */
    public function scopeFactionSpecific(Builder $query): Builder
    {
        return $query->whereHas('keywordType', function ($query) {
            $query->where('scope', 'faction');
        });
    }

    /**
     * Scope: Get equipment keywords
     */
    public function scopeEquipment(Builder $query): Builder
    {
        return $query->whereHas('keywordType', function ($query) {
            $query->where('scope', 'equipment');
        });
    }

    /**
     * Scope: Get unit keywords
     */
    public function scopeUnit(Builder $query): Builder
    {
        return $query->whereHas('keywordType', function ($query) {
            $query->where('scope', 'unit');
        });
    }

    /**
     * Scope: Get keywords that have active version entries
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereHas('versionEntries', function ($query) {
            $query->where('status', 'active');
        });
    }

    /**
     * Scope: Get active keywords ordered by name
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->active()->ordered();
    }

    /**
     * Scope: Search keywords by name or description
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description_markdown', 'like', "%{$search}%")
                ->orWhere('rule_text_markdown', 'like', "%{$search}%");
        });
    }

    /**
     * Check if this is a global keyword
     */
    public function isGlobal(): bool
    {
        return $this->keywordType->isGlobal();
    }

    /**
     * Check if this is a faction-specific keyword
     */
    public function isFactionSpecific(): bool
    {
        return $this->keywordType->isFactionSpecific();
    }

    /**
     * Check if this is an equipment keyword
     */
    public function isEquipment(): bool
    {
        return $this->keywordType->isEquipment();
    }

    /**
     * Check if this is a unit keyword
     */
    public function isUnit(): bool
    {
        return $this->keywordType->isUnit();
    }

    /**
     * Get the display name for this keyword
     */
    public function getDisplayNameAttribute(): string
    {
        return strtoupper($this->name);
    }

    /**
     * Get the current rule text (with version overrides applied)
     */
    public function getCurrentRuleText(): string
    {
        $latestEntry = $this->latestVersionEntry();

        if ($latestEntry && $latestEntry->content_override) {
            return $latestEntry->content_override['rule_text_markdown'] ?? $this->rule_text_markdown;
        }

        return $this->rule_text_markdown;
    }

    /**
     * Get the current description (with version overrides applied)
     */
    public function getCurrentDescription(): string
    {
        $latestEntry = $this->latestVersionEntry();

        if ($latestEntry && $latestEntry->content_override) {
            return $latestEntry->content_override['description_markdown'] ?? $this->description_markdown;
        }

        return $this->description_markdown;
    }

    /**
     * Get the current examples (with version overrides applied)
     */
    public function getCurrentExamples(): ?array
    {
        $latestEntry = $this->latestVersionEntry();

        if ($latestEntry && $latestEntry->content_override) {
            return $latestEntry->content_override['examples'] ?? $this->examples;
        }

        return $this->examples;
    }

    /**
     * Check if this keyword has examples
     */
    public function hasExamples(): bool
    {
        return ! empty($this->getCurrentExamples());
    }

    /**
     * Check if this keyword has version entries
     */
    public function hasVersionEntries(): bool
    {
        return $this->versionEntries()->exists();
    }

    /**
     * Check if this keyword has active version entries
     */
    public function hasActiveVersionEntries(): bool
    {
        return $this->activeVersionEntries()->exists();
    }

    /**
     * Check if this keyword is used by any rules
     */
    public function isUsedByRules(): bool
    {
        return $this->rules()->exists();
    }

    /**
     * Check if this keyword is used by any equipment
     */
    public function isUsedByEquipment(): bool
    {
        return $this->equipment()->exists();
    }

    /**
     * Check if this keyword is used by any base units
     */
    public function isUsedByBaseUnits(): bool
    {
        return $this->baseUnits()->exists();
    }
}
