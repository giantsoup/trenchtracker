<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KeywordType extends Model
{
    protected $fillable = [
        'name',
        'scope',
    ];

    protected $casts = [
        'scope' => 'string',
    ];

    /**
     * Relationship: A keyword type has many keywords
     */
    public function keywords(): HasMany
    {
        return $this->hasMany(Keyword::class);
    }

    /**
     * Get active keywords for this type
     */
    public function activeKeywords(): HasMany
    {
        return $this->keywords()->whereHas('versionEntries', function ($query) {
            $query->where('status', 'active');
        });
    }

    /**
     * Scope: Order keyword types by name
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('name');
    }

    /**
     * Scope: Get global keyword types
     */
    public function scopeGlobal(Builder $query): Builder
    {
        return $query->where('scope', 'global');
    }

    /**
     * Scope: Get faction-specific keyword types
     */
    public function scopeFaction(Builder $query): Builder
    {
        return $query->where('scope', 'faction');
    }

    /**
     * Scope: Get equipment keyword types
     */
    public function scopeEquipment(Builder $query): Builder
    {
        return $query->where('scope', 'equipment');
    }

    /**
     * Scope: Get unit keyword types
     */
    public function scopeUnit(Builder $query): Builder
    {
        return $query->where('scope', 'unit');
    }

    /**
     * Scope: Get keyword types that have keywords
     */
    public function scopeWithKeywords(Builder $query): Builder
    {
        return $query->whereHas('keywords');
    }

    /**
     * Scope: Get keyword types that have active keywords
     */
    public function scopeWithActiveKeywords(Builder $query): Builder
    {
        return $query->whereHas('keywords', function ($query) {
            $query->whereHas('versionEntries', function ($query) {
                $query->where('status', 'active');
            });
        });
    }

    /**
     * Check if this is a global keyword type
     */
    public function isGlobal(): bool
    {
        return $this->scope === 'global';
    }

    /**
     * Check if this is a faction-specific keyword type
     */
    public function isFactionSpecific(): bool
    {
        return $this->scope === 'faction';
    }

    /**
     * Check if this is an equipment keyword type
     */
    public function isEquipment(): bool
    {
        return $this->scope === 'equipment';
    }

    /**
     * Check if this is a unit keyword type
     */
    public function isUnit(): bool
    {
        return $this->scope === 'unit';
    }

    /**
     * Get the display name for this keyword type
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Check if this keyword type has any keywords
     */
    public function hasKeywords(): bool
    {
        return $this->keywords()->exists();
    }

    /**
     * Check if this keyword type has any active keywords
     */
    public function hasActiveKeywords(): bool
    {
        return $this->activeKeywords()->exists();
    }

    /**
     * Get the count of keywords for this type
     */
    public function getKeywordsCountAttribute(): int
    {
        return $this->keywords()->count();
    }

    /**
     * Get the count of active keywords for this type
     */
    public function getActiveKeywordsCountAttribute(): int
    {
        return $this->activeKeywords()->count();
    }
}
