<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RuleReference extends Model
{
    protected $fillable = [
        'source_rule_id',
        'target_rule_id',
        'reference_type',
        'context',
    ];

    protected $casts = [
        'source_rule_id' => 'integer',
        'target_rule_id' => 'integer',
    ];

    /**
     * Relationship: A rule reference belongs to a source rule
     */
    public function sourceRule(): BelongsTo
    {
        return $this->belongsTo(Rule::class, 'source_rule_id');
    }

    /**
     * Relationship: A rule reference belongs to a target rule
     */
    public function targetRule(): BelongsTo
    {
        return $this->belongsTo(Rule::class, 'target_rule_id');
    }

    /**
     * Scope: Get references by type
     */
    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('reference_type', $type);
    }

    /**
     * Scope: Get "see also" references
     */
    public function scopeSeeAlso(Builder $query): Builder
    {
        return $query->where('reference_type', 'see_also');
    }

    /**
     * Scope: Get "defines" references
     */
    public function scopeDefines(Builder $query): Builder
    {
        return $query->where('reference_type', 'defines');
    }

    /**
     * Scope: Get "modifies" references
     */
    public function scopeModifies(Builder $query): Builder
    {
        return $query->where('reference_type', 'modifies');
    }

    /**
     * Scope: Get "example" references
     */
    public function scopeExample(Builder $query): Builder
    {
        return $query->where('reference_type', 'example');
    }

    /**
     * Scope: Get references for a specific source rule
     */
    public function scopeForSourceRule(Builder $query, $ruleId): Builder
    {
        return $query->where('source_rule_id', $ruleId);
    }

    /**
     * Scope: Get references for a specific target rule
     */
    public function scopeForTargetRule(Builder $query, $ruleId): Builder
    {
        return $query->where('target_rule_id', $ruleId);
    }

    /**
     * Check if this is a "see also" reference
     */
    public function isSeeAlso(): bool
    {
        return $this->reference_type === 'see_also';
    }

    /**
     * Check if this is a "defines" reference
     */
    public function isDefines(): bool
    {
        return $this->reference_type === 'defines';
    }

    /**
     * Check if this is a "modifies" reference
     */
    public function isModifies(): bool
    {
        return $this->reference_type === 'modifies';
    }

    /**
     * Check if this is an "example" reference
     */
    public function isExample(): bool
    {
        return $this->reference_type === 'example';
    }

    /**
     * Get the display name for this reference
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->sourceRule->title.' → '.$this->targetRule->title.' ('.ucfirst(str_replace('_', ' ', $this->reference_type)).')';
    }

    /**
     * Check if this reference has context
     */
    public function hasContext(): bool
    {
        return ! empty($this->context);
    }
}
