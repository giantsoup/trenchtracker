<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WarbandVariant extends Model
{
    protected $fillable = [
        'faction_id',
        'name',
        'slug',
        'description',
        'special_rules',
        'icon',
        'starting_resources',
        'unit_restrictions',
        'equipment_restrictions',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'starting_resources' => 'array',
        'unit_restrictions' => 'array',
        'equipment_restrictions' => 'array',
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
     * Relationship: A warband variant belongs to a faction
     */
    public function faction(): BelongsTo
    {
        return $this->belongsTo(Faction::class);
    }

    /**
     * Relationship: A warband variant has many warbands
     */
    //    public function warbands(): HasMany
    //    {
    //        return $this->hasMany(Warband::class);
    //    }

    /**
     * Scope: Get only active variants
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order variants by sort order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope: Get active variants ordered by sort order
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->active()->ordered();
    }

    /**
     * Scope: Filter by faction
     */
    public function scopeForFaction(Builder $query, Faction|int|string $faction): Builder
    {
        if ($faction instanceof Faction) {
            return $query->where('faction_id', $faction->id);
        }

        if (is_numeric($faction)) {
            return $query->where('faction_id', $faction);
        }

        // Assume it's a faction slug
        return $query->whereHas('faction', function (Builder $query) use ($faction) {
            $query->where('slug', $faction);
        });
    }

    /**
     * Get the variant's full display name (includes faction name)
     */
    public function getFullNameAttribute(): string
    {
        return $this->faction->name.': '.$this->name;
    }

    /**
     * Get starting ducats for this variant
     */
    public function getStartingDucatsAttribute(): int
    {
        return $this->starting_resources['ducats'] ?? 700; // Default campaign starting amount
    }

    /**
     * Get starting glory points for this variant
     */
    public function getStartingGloryPointsAttribute(): int
    {
        return $this->starting_resources['glory_points'] ?? 0;
    }

    /**
     * Check if a unit type is restricted
     */
    public function isUnitRestricted(string $unitType, int $currentCount = 0): bool
    {
        $restrictions = $this->unit_restrictions ?? [];

        if (isset($restrictions["max_{$unitType}"])) {
            return $currentCount >= $restrictions["max_{$unitType}"];
        }

        return false;
    }

    /**
     * Check if minimum unit requirements are met
     */
    public function areMinimumUnitsMet(array $unitCounts): bool
    {
        $restrictions = $this->unit_restrictions ?? [];

        foreach ($restrictions as $key => $minCount) {
            if (str_starts_with($key, 'min_')) {
                $unitType = substr($key, 4);
                $currentCount = $unitCounts[$unitType] ?? 0;

                if ($currentCount < $minCount) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Check if equipment is banned for this variant
     */
    public function isEquipmentBanned(string $equipmentType): bool
    {
        $restrictions = $this->equipment_restrictions ?? [];
        $banned = $restrictions['banned'] ?? [];

        return in_array($equipmentType, $banned);
    }

    /**
     * Check if equipment has special access for this variant
     */
    public function hasSpecialEquipmentAccess(string $equipmentType): bool
    {
        $restrictions = $this->equipment_restrictions ?? [];
        $specialAccess = $restrictions['special_access'] ?? [];

        return in_array($equipmentType, $specialAccess);
    }

    /**
     * Get all special resources for this variant
     */
    public function getSpecialResourcesAttribute(): array
    {
        $resources = $this->starting_resources ?? [];
        $special = [];

        foreach ($resources as $key => $value) {
            if (! in_array($key, ['ducats', 'glory_points'])) {
                $special[$key] = $value;
            }
        }

        return $special;
    }

    /**
     * Get formatted special rules as HTML
     */
    public function getFormattedSpecialRulesAttribute(): string
    {
        if (empty($this->special_rules)) {
            return '';
        }

        // Convert simple line breaks to HTML and handle basic formatting
        return nl2br(e($this->special_rules));
    }
}
