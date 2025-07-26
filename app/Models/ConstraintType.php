<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConstraintType extends Model
{
    protected $fillable = [
        'name',
        'scope',
        'description',
    ];

    protected $casts = [
        'scope' => 'string',
    ];

    /**
     * Relationship: A constraint type has many constraints
     */
    public function constraints(): HasMany
    {
        return $this->hasMany(Constraint::class);
    }

    /**
     * Scope: Order constraint types by name
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('name');
    }

    /**
     * Scope: Get constraint types by scope
     */
    public function scopeByScope(Builder $query, string $scope): Builder
    {
        return $query->where('scope', $scope);
    }

    /**
     * Scope: Get unit type constraint types
     */
    public function scopeUnitType(Builder $query): Builder
    {
        return $query->where('scope', 'unit_type');
    }

    /**
     * Scope: Get keyword constraint types
     */
    public function scopeKeyword(Builder $query): Builder
    {
        return $query->where('scope', 'keyword');
    }

    /**
     * Scope: Get faction constraint types
     */
    public function scopeFaction(Builder $query): Builder
    {
        return $query->where('scope', 'faction');
    }

    /**
     * Scope: Get warband size constraint types
     */
    public function scopeWarbandSize(Builder $query): Builder
    {
        return $query->where('scope', 'warband_size');
    }

    /**
     * Scope: Get equipment exclusion constraint types
     */
    public function scopeEquipmentExclusion(Builder $query): Builder
    {
        return $query->where('scope', 'equipment_exclusion');
    }

    /**
     * Scope: Get constraint types that have constraints
     */
    public function scopeWithConstraints(Builder $query): Builder
    {
        return $query->whereHas('constraints');
    }

    /**
     * Check if this is a unit type constraint
     */
    public function isUnitType(): bool
    {
        return $this->scope === 'unit_type';
    }

    /**
     * Check if this is a keyword constraint
     */
    public function isKeyword(): bool
    {
        return $this->scope === 'keyword';
    }

    /**
     * Check if this is a faction constraint
     */
    public function isFaction(): bool
    {
        return $this->scope === 'faction';
    }

    /**
     * Check if this is a warband size constraint
     */
    public function isWarbandSize(): bool
    {
        return $this->scope === 'warband_size';
    }

    /**
     * Check if this is an equipment exclusion constraint
     */
    public function isEquipmentExclusion(): bool
    {
        return $this->scope === 'equipment_exclusion';
    }

    /**
     * Get the display name for this constraint type
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Check if this constraint type has any constraints
     */
    public function hasConstraints(): bool
    {
        return $this->constraints()->exists();
    }

    /**
     * Get the count of constraints for this type
     */
    public function getConstraintsCountAttribute(): int
    {
        return $this->constraints()->count();
    }

    /**
     * Get the scope display name
     */
    public function getScopeDisplayNameAttribute(): string
    {
        return match ($this->scope) {
            'unit_type' => 'Unit Type',
            'keyword' => 'Keyword',
            'faction' => 'Faction',
            'warband_size' => 'Warband Size',
            'equipment_exclusion' => 'Equipment Exclusion',
            default => ucfirst(str_replace('_', ' ', $this->scope)),
        };
    }
}
