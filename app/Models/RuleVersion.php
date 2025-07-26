<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RuleVersion extends Model
{
    protected $fillable = [
        'version_number',
        'type',
        'release_date',
        'is_active',
        'pdf_path',
        'notes',
    ];

    protected $casts = [
        'release_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'version_number';
    }

    /**
     * Relationship: A rule version has many rule version entries
     */
    public function ruleVersionEntries(): HasMany
    {
        return $this->hasMany(RuleVersionEntry::class);
    }

    /**
     * Relationship: A rule version has many keyword version entries
     */
    public function keywordVersionEntries(): HasMany
    {
        return $this->hasMany(KeywordVersionEntry::class);
    }

    /**
     * Scope: Get only active rule versions
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order rule versions by release date (newest first)
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('release_date', 'desc')->orderBy('version_number', 'desc');
    }

    /**
     * Scope: Get active rule versions ordered by release date
     */
    public function scopeActiveOrdered(Builder $query): Builder
    {
        return $query->active()->ordered();
    }

    /**
     * Scope: Get base rule versions only
     */
    public function scopeBase(Builder $query): Builder
    {
        return $query->where('type', 'base');
    }

    /**
     * Scope: Get errata rule versions only
     */
    public function scopeErrata(Builder $query): Builder
    {
        return $query->where('type', 'errata');
    }

    /**
     * Scope: Get expansion rule versions only
     */
    public function scopeExpansion(Builder $query): Builder
    {
        return $query->where('type', 'expansion');
    }

    /**
     * Check if this is a base rule version
     */
    public function isBase(): bool
    {
        return $this->type === 'base';
    }

    /**
     * Check if this is an errata rule version
     */
    public function isErrata(): bool
    {
        return $this->type === 'errata';
    }

    /**
     * Check if this is an expansion rule version
     */
    public function isExpansion(): bool
    {
        return $this->type === 'expansion';
    }

    /**
     * Get the display name for this rule version
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->version_number.' ('.ucfirst($this->type).')';
    }

    /**
     * Check if this rule version has a downloadable PDF
     */
    public function hasPdf(): bool
    {
        return ! empty($this->pdf_path);
    }

    /**
     * Get the full PDF URL
     */
    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_path ? asset('storage/'.$this->pdf_path) : null;
    }
}
