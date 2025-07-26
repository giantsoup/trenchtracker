<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Constraint extends Model
{
    protected $fillable = [
        'constrainable_type',
        'constrainable_id',
        'constraint_type_id',
        'parameters',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'parameters' => 'array',
            'constrainable_id' => 'integer',
            'constraint_type_id' => 'integer',
        ];
    }

    /**
     * Polymorphic relationship: Get the constrainable model
     */
    public function constrainable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relationship: A constraint belongs to a constraint type
     */
    public function constraintType(): BelongsTo
    {
        return $this->belongsTo(ConstraintType::class);
    }

    /**
     * Scope: Get constraints by constraint type
     */
    public function scopeByType(Builder $query, int $constraintTypeId): Builder
    {
        return $query->where('constraint_type_id', $constraintTypeId);
    }

    /**
     * Scope: Get constraints for a specific constrainable type
     */
    public function scopeForConstrainableType(Builder $query, string $constrainableType): Builder
    {
        return $query->where('constrainable_type', $constrainableType);
    }

    /**
     * Scope: Get constraints for equipment
     */
    public function scopeForEquipment(Builder $query): Builder
    {
        return $query->where('constrainable_type', Equipment::class);
    }

    /**
     * Scope: Get constraints for base units
     */
    public function scopeForBaseUnits(Builder $query): Builder
    {
        return $query->where('constrainable_type', BaseUnit::class);
    }

    /**
     * Scope: Get unit type constraints
     */
    public function scopeUnitType(Builder $query): Builder
    {
        return $query->whereHas('constraintType', function ($query) {
            $query->where('scope', 'unit_type');
        });
    }

    /**
     * Scope: Get keyword constraints
     */
    public function scopeKeyword(Builder $query): Builder
    {
        return $query->whereHas('constraintType', function ($query) {
            $query->where('scope', 'keyword');
        });
    }

    /**
     * Scope: Get faction constraints
     */
    public function scopeFaction(Builder $query): Builder
    {
        return $query->whereHas('constraintType', function ($query) {
            $query->where('scope', 'faction');
        });
    }

    /**
     * Scope: Get warband size constraints
     */
    public function scopeWarbandSize(Builder $query): Builder
    {
        return $query->whereHas('constraintType', function ($query) {
            $query->where('scope', 'warband_size');
        });
    }

    /**
     * Scope: Get equipment exclusion constraints
     */
    public function scopeEquipmentExclusion(Builder $query): Builder
    {
        return $query->whereHas('constraintType', function ($query) {
            $query->where('scope', 'equipment_exclusion');
        });
    }

    /**
     * Check if this is a unit type constraint
     */
    public function isUnitType(): bool
    {
        return $this->constraintType->isUnitType();
    }

    /**
     * Check if this is a keyword constraint
     */
    public function isKeyword(): bool
    {
        return $this->constraintType->isKeyword();
    }

    /**
     * Check if this is a faction constraint
     */
    public function isFaction(): bool
    {
        return $this->constraintType->isFaction();
    }

    /**
     * Check if this is a warband size constraint
     */
    public function isWarbandSize(): bool
    {
        return $this->constraintType->isWarbandSize();
    }

    /**
     * Check if this is an equipment exclusion constraint
     */
    public function isEquipmentExclusion(): bool
    {
        return $this->constraintType->isEquipmentExclusion();
    }

    /**
     * Get the display name for this constraint
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->constraintType->name.' constraint';
    }

    /**
     * Check if this constraint has parameters
     */
    public function hasParameters(): bool
    {
        return ! empty($this->parameters);
    }

    /**
     * Get a specific parameter value
     */
    public function getParameter(string $key, $default = null)
    {
        return $this->parameters[$key] ?? $default;
    }

    /**
     * Check if constraint has a specific parameter
     */
    public function hasParameter(string $key): bool
    {
        return isset($this->parameters[$key]);
    }

    /**
     * Get the constrainable model name
     */
    public function getConstrainableModelNameAttribute(): string
    {
        return class_basename($this->constrainable_type);
    }
}
