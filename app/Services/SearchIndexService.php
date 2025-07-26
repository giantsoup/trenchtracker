<?php

namespace App\Services;

use App\Models\SearchableContent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SearchIndexService
{
    /**
     * Reindex all searchable content in the system.
     */
    public function reindexAll(): int
    {
        $indexed = 0;

        // Clear existing search index
        SearchableContent::truncate();

        // Index all rules
        $rules = DB::table('rules')->get();
        foreach ($rules as $rule) {
            $this->indexRule($rule);
            $indexed++;
        }

        // Index all keywords (if they exist)
        if (DB::getSchemaBuilder()->hasTable('keywords')) {
            $keywords = DB::table('keywords')->get();
            foreach ($keywords as $keyword) {
                $this->indexKeyword($keyword);
                $indexed++;
            }
        }

        // Index all equipment (if they exist)
        if (DB::getSchemaBuilder()->hasTable('equipment')) {
            $equipment = DB::table('equipment')->get();
            foreach ($equipment as $item) {
                $this->indexEquipment($item);
                $indexed++;
            }
        }

        return $indexed;
    }

    /**
     * Index an individual item.
     */
    public function indexItem(Model $item): SearchableContent
    {
        // Remove existing index for this item
        SearchableContent::where('searchable_type', get_class($item))
            ->where('searchable_id', $item->id)
            ->delete();

        // Create new index entry
        return $this->createIndexEntry($item);
    }

    /**
     * Perform a search with optional filters.
     */
    public function search(
        string $query,
        ?string $contentType = null,
        ?int $rulePhaseId = null,
        ?array $keywords = null,
        ?string $version = null,
        int $limit = 50
    ): Collection {
        $searchQuery = SearchableContent::query();

        // Apply full-text search if query provided
        if (! empty($query)) {
            $searchQuery->search($query);
        }

        // Apply filters
        if ($contentType) {
            $searchQuery->ofType($contentType);
        }

        if ($rulePhaseId) {
            $searchQuery->forPhase($rulePhaseId);
        }

        if ($keywords) {
            foreach ($keywords as $keyword) {
                $searchQuery->withKeyword($keyword);
            }
        }

        if ($version) {
            $searchQuery->forVersion($version);
        }

        return $searchQuery->with(['searchable', 'rulePhase'])
            ->limit($limit)
            ->get();
    }

    /**
     * Highlight search terms in the given text.
     */
    public function highlightSearchTerms(string $text, string $searchTerm): string
    {
        if (empty($searchTerm)) {
            return $text;
        }

        // Split search term into individual words
        $terms = array_filter(explode(' ', $searchTerm));

        foreach ($terms as $term) {
            // Escape special regex characters
            $escapedTerm = preg_quote($term, '/');

            // Highlight the term (case-insensitive)
            $text = preg_replace(
                '/('.$escapedTerm.')/i',
                '<mark class="bg-yellow-200 dark:bg-yellow-800">$1</mark>',
                $text
            );
        }

        return $text;
    }

    /**
     * Create a search index entry for a rule.
     */
    private function indexRule($rule): SearchableContent
    {
        return SearchableContent::create([
            'searchable_type' => 'App\Models\Rule',
            'searchable_id' => $rule->id,
            'title' => $rule->name,
            'content_text' => $this->extractTextContent($rule->description ?? '', $rule->mechanics ?? ''),
            'keywords' => $this->extractKeywords($rule),
            'version_tags' => $this->extractVersionTags($rule),
            'content_type' => 'rule',
            'rule_phase_id' => $rule->rule_phase_id,
        ]);
    }

    /**
     * Create a search index entry for a keyword.
     */
    private function indexKeyword($keyword): SearchableContent
    {
        return SearchableContent::create([
            'searchable_type' => 'App\Models\Keyword',
            'searchable_id' => $keyword->id,
            'title' => $keyword->name,
            'content_text' => $this->extractTextContent($keyword->description ?? ''),
            'keywords' => [$keyword->name],
            'version_tags' => $this->extractVersionTags($keyword),
            'content_type' => 'keyword',
            'rule_phase_id' => null,
        ]);
    }

    /**
     * Create a search index entry for equipment.
     */
    private function indexEquipment($equipment): SearchableContent
    {
        return SearchableContent::create([
            'searchable_type' => 'App\Models\Equipment',
            'searchable_id' => $equipment->id,
            'title' => $equipment->name,
            'content_text' => $this->extractTextContent($equipment->description ?? ''),
            'keywords' => $this->extractKeywords($equipment),
            'version_tags' => $this->extractVersionTags($equipment),
            'content_type' => 'equipment',
            'rule_phase_id' => null,
        ]);
    }

    /**
     * Create a search index entry for any model.
     */
    private function createIndexEntry(Model $item): SearchableContent
    {
        $contentType = match (get_class($item)) {
            'App\Models\Rule' => 'rule',
            'App\Models\Keyword' => 'keyword',
            'App\Models\Equipment' => 'equipment',
            default => 'unknown',
        };

        return SearchableContent::create([
            'searchable_type' => get_class($item),
            'searchable_id' => $item->id,
            'title' => $item->name ?? $item->title ?? 'Untitled',
            'content_text' => $this->extractTextContent(
                $item->description ?? '',
                $item->mechanics ?? ''
            ),
            'keywords' => $this->extractKeywords($item),
            'version_tags' => $this->extractVersionTags($item),
            'content_type' => $contentType,
            'rule_phase_id' => $item->rule_phase_id ?? null,
        ]);
    }

    /**
     * Extract searchable text content from various fields.
     */
    private function extractTextContent(string ...$fields): string
    {
        $content = implode(' ', array_filter($fields));

        // Strip HTML/Markdown and normalize whitespace
        $content = strip_tags($content);
        $content = preg_replace('/\s+/', ' ', $content);

        return trim($content);
    }

    /**
     * Extract keywords from an item.
     */
    private function extractKeywords($item): array
    {
        $keywords = [];

        // Add the item name as a keyword
        if (isset($item->name)) {
            $keywords[] = $item->name;
        }

        // Add any explicit keywords if they exist
        if (isset($item->keywords) && is_array($item->keywords)) {
            $keywords = array_merge($keywords, $item->keywords);
        }

        // Add any tags if they exist
        if (isset($item->tags) && is_array($item->tags)) {
            $keywords = array_merge($keywords, $item->tags);
        }

        return array_unique(array_filter($keywords));
    }

    /**
     * Extract version tags from an item.
     */
    private function extractVersionTags($item): array
    {
        $versions = [];

        // Add base version
        if (isset($item->base_version)) {
            $versions[] = $item->base_version;
        }

        // Add errata versions if they exist
        if (isset($item->errata_versions) && is_array($item->errata_versions)) {
            $versions = array_merge($versions, $item->errata_versions);
        }

        // Default to current version if no versions specified
        if (empty($versions)) {
            $versions[] = 'v1.6.3'; // Current version based on docs
        }

        return array_unique($versions);
    }
}
