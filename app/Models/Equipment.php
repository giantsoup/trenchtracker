<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Equipment extends Model
{
    protected $fillable = [
        'name',
        'type',
        'category_id',
        'base_cost',
        'stats',
        'lore_markdown',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'base_cost' => 'array',
            'stats' => 'array',
            'category_id' => 'integer',
        ];
    }

    /**
     * Relationship: Equipment belongs to a category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class, 'category_id');
    }

    /**
     * Polymorphic relationship: Equipment can have many keywords
     */
    public function keywords(): MorphToMany
    {
        return $this->morphToMany(Keyword::class, 'keywordable');
    }

    /**
     * Polymorphic relationship: Equipment can have many constraints
     */
    public function constraints(): MorphMany
    {
        return $this->morphMany(Constraint::class, 'constrainable');
    }

    /**
     * Scope: Order equipment by name
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('name');
    }

    /**
     * Scope: Get equipment by type
     */
    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Scope: Get equipment in a specific category
     */
    public function scopeInCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope: Get melee weapons
     */
    public function scopeMeleeWeapons(Builder $query): Builder
    {
        return $query->where('type', 'melee_weapon');
    }

    /**
     * Scope: Get ranged weapons
     */
    public function scopeRangedWeapons(Builder $query): Builder
    {
        return $query->where('type', 'ranged_weapon');
    }

    /**
     * Scope: Get armor
     */
    public function scopeArmor(Builder $query): Builder
    {
        return $query->where('type', 'armor');
    }

    /**
     * Scope: Get equipment with keywords
     */
    public function scopeWithKeywords(Builder $query): Builder
    {
        return $query->whereHas('keywords');
    }

    /**
     * Scope: Get equipment with constraints
     */
    public function scopeWithConstraints(Builder $query): Builder
    {
        return $query->whereHas('constraints');
    }

    /**
     * Scope: Search equipment by name or lore
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('lore_markdown', 'like', "%{$search}%");
        });
    }

    /**
     * Check if this is a melee weapon
     */
    public function isMeleeWeapon(): bool
    {
        return $this->type === 'melee_weapon';
    }

    /**
     * Check if this is a ranged weapon
     */
    public function isRangedWeapon(): bool
    {
        return $this->type === 'ranged_weapon';
    }

    /**
     * Check if this is armor
     */
    public function isArmor(): bool
    {
        return $this->type === 'armor';
    }

    /**
     * Get the display name for this equipment
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get the total cost in ducats.
     */
    public function getDucatCostAttribute(): int
    {
        return $this->base_cost['ducats'] ?? 0;
    }

    /**
     * Get the glory point cost.
     */
    public function getGloryPointCostAttribute(): int
    {
        return $this->base_cost['glory_points'] ?? 0;
    }

    /**
     * Check if this equipment has any keywords
     */
    public function hasKeywords(): bool
    {
        return $this->keywords()->exists();
    }

    /**
     * Check if this equipment has any constraints
     */
    public function hasConstraints(): bool
    {
        return $this->constraints()->exists();
    }

    /**
     * Check if this equipment has lore
     */
    public function hasLore(): bool
    {
        return ! empty($this->lore_markdown);
    }

    /**
     * Check if this equipment has stats
     */
    public function hasStats(): bool
    {
        return ! empty($this->stats);
    }

    /**
     * Get the type display name
     */
    public function getTypeDisplayNameAttribute(): string
    {
        return match ($this->type) {
            'melee_weapon' => 'Melee Weapon',
            'ranged_weapon' => 'Ranged Weapon',
            'armor' => 'Armor',
            default => ucfirst(str_replace('_', ' ', $this->type)),
        };
    }

    /**
     * Get a specific stat value
     */
    public function getStat(string $key, $default = null)
    {
        return $this->stats[$key] ?? $default;
    }

    /**
     * Check if equipment has a specific stat
     */
    public function hasStat(string $key): bool
    {
        return isset($this->stats[$key]);
    }
}
