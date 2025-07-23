<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseUnit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'faction_id',
        'warband_variant_id',
        'unit_type',
        'role',
        'movement',
        'melee',
        'ranged',
        'strength',
        'fortitude',
        'leadership',
        'faith',
        'base_cost',
        'upkeep_cost',
        'max_wounds',
        'min_warband_size',
        'max_per_warband',
        'is_leader',
        'is_unique',
        'starting_equipment',
        'equipment_options',
        'stat_advancement_options',
        'special_rules',
        'keywords',
        'lore_text',
        'is_active',
        'source_book',
        'variant_restrictions',
        'version',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'movement' => 'integer',
        'melee' => 'integer',
        'ranged' => 'integer',
        'strength' => 'integer',
        'fortitude' => 'integer',
        'leadership' => 'integer',
        'faith' => 'integer',
        'base_cost' => 'integer',
        'upkeep_cost' => 'integer',
        'max_wounds' => 'integer',
        'min_warband_size' => 'integer',
        'max_per_warband' => 'integer',
        'is_leader' => 'boolean',
        'is_unique' => 'boolean',
        'starting_equipment' => 'array',
        'equipment_options' => 'array',
        'stat_advancement_options' => 'array',
        'special_rules' => 'array',
        'keywords' => 'array',
        'variant_restrictions' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the faction this unit belongs to.
     */
    public function faction(): BelongsTo
    {
        return $this->belongsTo(Faction::class);
    }

    /**
     * Get the warband variant this unit belongs to (if any).
     */
    public function warbandVariant(): BelongsTo
    {
        return $this->belongsTo(WarbandVariant::class);
    }

    /**
     * Get the player units created from this base unit.
     */
    //    public function units(): HasMany
    //    {
    //        return $this->hasMany(Unit::class);
    //    }

    /**
     * Scope a query to only include active units.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to filter by faction.
     */
    public function scopeForFaction($query, int $factionId)
    {
        return $query->where('faction_id', $factionId);
    }

    /**
     * Scope a query to filter by warband variant.
     */
    public function scopeForWarbandVariant($query, int $warbandVariantId)
    {
        return $query->where('warband_variant_id', $warbandVariantId);
    }

    /**
     * Scope a query to only include units available to all variants (no specific variant restriction).
     */
    public function scopeAvailableToAllVariants($query)
    {
        return $query->whereNull('warband_variant_id');
    }

    /**
     * Scope a query to filter by unit type.
     */
    public function scopeOfType($query, string $unitType)
    {
        return $query->where('unit_type', $unitType);
    }

    /**
     * Scope a query to filter by role.
     */
    public function scopeWithRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope a query to only include leaders.
     */
    public function scopeLeaders($query)
    {
        return $query->where('is_leader', true);
    }

    /**
     * Scope a query to only include non-leaders.
     */
    public function scopeNonLeaders($query)
    {
        return $query->where('is_leader', false);
    }

    /**
     * Scope a query to filter by cost range.
     */
    public function scopeCostBetween($query, int $minCost, int $maxCost)
    {
        return $query->whereBetween('base_cost', [$minCost, $maxCost]);
    }

    /**
     * Get the unit's display name with type.
     */
    public function getDisplayNameAttribute(): string
    {
        return "{$this->name} ({$this->unit_type})";
    }

    /**
     * Get the unit's total cost including upkeep.
     */
    public function getTotalCostAttribute(): int
    {
        return $this->base_cost + $this->upkeep_cost;
    }

    /**
     * Get all stats as an array.
     */
    public function getStatsAttribute(): array
    {
        return [
            'movement' => $this->movement,
            'melee' => $this->melee,
            'ranged' => $this->ranged,
            'strength' => $this->strength,
            'fortitude' => $this->fortitude,
            'leadership' => $this->leadership,
            'faith' => $this->faith,
        ];
    }

    /**
     * Check if this unit can be taken by a warband of a given size.
     */
    public function canBeTakenByWarband(int $warbandSize): bool
    {
        return $warbandSize >= $this->min_warband_size;
    }

    /**
     * Get the maximum number that can be taken per warband.
     */
    public function getMaxPerWarbandAttribute(): int
    {
        return $this->attributes['max_per_warband'];
    }

    /**
     * Check if this is a unique unit.
     */
    public function isUnique(): bool
    {
        return $this->is_unique;
    }

    /**
     * Check if this unit can be a warband leader.
     */
    public function canBeLeader(): bool
    {
        return $this->is_leader;
    }
}
