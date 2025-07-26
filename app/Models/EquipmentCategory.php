<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'sort_order',
    ];

    protected $casts = [
        'parent_id' => 'integer',
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
     * Relationship: A category belongs to a parent category
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class, 'parent_id');
    }

    /**
     * Relationship: A category has many child categories
     */
    public function children(): HasMany
    {
        return $this->hasMany(EquipmentCategory::class, 'parent_id')->orderBy('sort_order');
    }

    /**
     * Relationship: A category has many equipment items
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }

    /**
     * Scope: Get only root categories (no parent)
     */
    public function scopeRoots(Builder $query): Builder
    {
        return $query->whereNull('parent_id')->orderBy('sort_order');
    }

    /**
     * Scope: Order categories by sort order
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Scope: Get categories that have children
     */
    public function scopeWithChildren(Builder $query): Builder
    {
        return $query->whereHas('children');
    }

    /**
     * Scope: Get categories that have equipment
     */
    public function scopeWithEquipment(Builder $query): Builder
    {
        return $query->whereHas('equipment');
    }

    /**
     * Scope: Get leaf categories (no children)
     */
    public function scopeLeaves(Builder $query): Builder
    {
        return $query->whereDoesntHave('children');
    }

    /**
     * Scope: Get categories by parent
     */
    public function scopeByParent(Builder $query, ?int $parentId): Builder
    {
        if ($parentId === null) {
            return $query->whereNull('parent_id');
        }

        return $query->where('parent_id', $parentId);
    }

    /**
     * Check if this is a root category
     */
    public function isRoot(): bool
    {
        return $this->parent_id === null;
    }

    /**
     * Check if this is a leaf category (has no children)
     */
    public function isLeaf(): bool
    {
        return ! $this->hasChildren();
    }

    /**
     * Check if this category has children
     */
    public function hasChildren(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Check if this category has equipment
     */
    public function hasEquipment(): bool
    {
        return $this->equipment()->exists();
    }

    /**
     * Check if this category has a parent
     */
    public function hasParent(): bool
    {
        return $this->parent_id !== null;
    }

    /**
     * Get the display name for this category
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get the full path name (including parent names)
     */
    public function getFullPathAttribute(): string
    {
        if ($this->isRoot()) {
            return $this->name;
        }

        return $this->parent->full_path.' > '.$this->name;
    }

    /**
     * Get the depth level of this category
     */
    public function getDepthAttribute(): int
    {
        if ($this->isRoot()) {
            return 0;
        }

        return $this->parent->depth + 1;
    }

    /**
     * Get all descendants (children, grandchildren, etc.)
     */
    public function descendants(): HasMany
    {
        return $this->hasMany(EquipmentCategory::class, 'parent_id')
            ->with('descendants');
    }

    /**
     * Get all ancestors (parent, grandparent, etc.)
     */
    public function ancestors()
    {
        $ancestors = collect();
        $current = $this->parent;

        while ($current) {
            $ancestors->push($current);
            $current = $current->parent;
        }

        return $ancestors->reverse();
    }

    /**
     * Get the count of equipment in this category
     */
    public function getEquipmentCountAttribute(): int
    {
        return $this->equipment()->count();
    }

    /**
     * Get the count of child categories
     */
    public function getChildrenCountAttribute(): int
    {
        return $this->children()->count();
    }
}
