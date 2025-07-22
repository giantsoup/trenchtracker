<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faction extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'lore',
        'primary_color',
        'secondary_color',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
     * Relationship: A faction has many warband variants
     */
    public function warbandVariants(): HasMany
    {
        return $this->hasMany(WarbandVariant::class);
    }

    /**
     * Relationship: A faction has many warbands
     */
    //    public function warbands(): HasMany
    //    {
    //        return $this->hasMany(Warband::class);
    //    }

    /**
     * Scope: Get only active factions
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order factions by sort order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope: Get active factions ordered by sort order
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->active()->ordered();
    }

    /**
     * Get active warband variants for this faction
     */
    public function activeWarbandVariants(): HasMany
    {
        return $this->warbandVariants()->where('is_active', true)->orderBy('sort_order');
    }

    /**
     * Check if faction has any active variants
     */
    public function hasActiveVariants(): bool
    {
        return $this->activeWarbandVariants()->exists();
    }

    /**
     * Get the faction's display name with appropriate article
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get the CSS color variables for this faction
     */
    public function getColorVariablesAttribute(): array
    {
        return [
            '--faction-primary' => $this->primary_color ?? '#333333',
            '--faction-secondary' => $this->secondary_color ?? '#666666',
        ];
    }

    /**
     * Get the inline CSS style string for this faction's colors
     */
    public function getColorStyleAttribute(): string
    {
        return collect($this->color_variables)
            ->map(fn ($value, $key) => "{$key}: {$value}")
            ->implode('; ');
    }

    /**
     * Get all base units for this faction
     */
    public function baseUnits(): HasMany
    {
        return $this->hasMany(BaseUnit::class);
    }

    /**
     * Get all active base units for this faction
     */
    public function activeBaseUnits(): HasMany
    {
        return $this->baseUnits()->where('is_active', true);
    }
}
