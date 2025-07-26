<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RulePhase extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'description',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Relationship: A rule phase has many rules
     */
    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    /**
     * Get active rules for this phase
     */
    public function activeRules(): HasMany
    {
        return $this->rules()->where('is_searchable', true);
    }

    /**
     * Get searchable rules for this phase
     */
    public function searchableRules(): HasMany
    {
        return $this->rules()->where('is_searchable', true);
    }

    /**
     * Scope: Order rule phases by sort order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope: Get phases that have rules
     */
    public function scopeWithRules(Builder $query): Builder
    {
        return $query->whereHas('rules');
    }

    /**
     * Scope: Get phases that have searchable rules
     */
    public function scopeWithSearchableRules(Builder $query): Builder
    {
        return $query->whereHas('rules', function ($query) {
            $query->where('is_searchable', true);
        });
    }

    /**
     * Get the display name for this rule phase
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Check if this phase has any rules
     */
    public function hasRules(): bool
    {
        return $this->rules()->exists();
    }

    /**
     * Check if this phase has any searchable rules
     */
    public function hasSearchableRules(): bool
    {
        return $this->searchableRules()->exists();
    }

    /**
     * Get the count of rules in this phase
     */
    public function getRulesCountAttribute(): int
    {
        return $this->rules()->count();
    }

    /**
     * Get the count of searchable rules in this phase
     */
    public function getSearchableRulesCountAttribute(): int
    {
        return $this->searchableRules()->count();
    }
}
