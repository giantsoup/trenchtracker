<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    /**
     * List all keywords
     */
    public function index(Request $request): JsonResponse
    {
        $query = Keyword::query()
            ->with(['keywordType', 'versionEntries.ruleVersion'])
            ->whereHas('versionEntries');

        // Filter by type
        if ($request->has('type')) {
            $query->whereHas('keywordType', function (Builder $q) use ($request) {
                $q->where('slug', $request->type);
            });
        }

        // Filter by scope (global, faction, equipment, unit)
        if ($request->has('scope')) {
            $query->whereHas('keywordType', function (Builder $q) use ($request) {
                $q->where('scope', $request->scope);
            });
        }

        // Search by name or description
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description_markdown', 'like', "%{$searchTerm}%")
                    ->orWhere('rule_text_markdown', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by version
        if ($request->has('version')) {
            $query->whereHas('versionEntries.ruleVersion', function (Builder $q) use ($request) {
                $q->where('version_number', $request->version);
            });
        }

        $keywords = $query->orderBy('name')->paginate(20);

        return response()->json([
            'data' => $keywords->items(),
            'meta' => [
                'current_page' => $keywords->currentPage(),
                'last_page' => $keywords->lastPage(),
                'per_page' => $keywords->perPage(),
                'total' => $keywords->total(),
            ],
        ]);
    }

    /**
     * Get keyword with all related content
     */
    public function show(string $name): JsonResponse
    {
        $keyword = Keyword::where('name', $name)
            ->with([
                'keywordType',
                'versionEntries' => function ($query) {
                    $query->with('ruleVersion')->orderByDesc('created_at');
                },
                'rules' => function ($query) {
                    $query->where('is_searchable', true)->with('rulePhase');
                },
                'equipment' => function ($query) {
                    $query->with('category');
                },
                'baseUnits',
            ])
            ->first();

        if (! $keyword) {
            return response()->json([
                'error' => 'Keyword not found',
            ], 404);
        }

        // Get version info
        $latestVersionEntry = $keyword->versionEntries->first();
        $versionInfo = null;

        if ($latestVersionEntry) {
            $ruleVersion = $latestVersionEntry->ruleVersion;
            $versionInfo = [
                'display_version' => $this->getDisplayVersion($ruleVersion),
                'sources' => [$ruleVersion->source_name],
                'pdf_downloads' => $ruleVersion->pdf_url ? [$ruleVersion->pdf_url] : [],
            ];
        }

        // Get current rule text (from latest version or fallback to base)
        $currentRuleText = $keyword->getCurrentRuleText();

        return response()->json([
            'data' => [
                'keyword' => [
                    'id' => $keyword->id,
                    'name' => $keyword->name,
                    'slug' => $keyword->slug,
                    'description_markdown' => $keyword->description_markdown,
                    'rule_text_markdown' => $currentRuleText,
                    'examples' => $keyword->examples,
                    'is_global' => $keyword->is_global,
                    'keyword_type' => $keyword->keywordType,
                    'created_at' => $keyword->created_at,
                    'updated_at' => $keyword->updated_at,
                ],
                'version_info' => $versionInfo,
                'relationships' => [
                    'rules' => $keyword->rules,
                    'equipment' => $keyword->equipment,
                    'base_units' => $keyword->baseUnits,
                ],
                'usage_stats' => [
                    'rules_count' => $keyword->rules->count(),
                    'equipment_count' => $keyword->equipment->count(),
                    'base_units_count' => $keyword->baseUnits->count(),
                ],
            ],
        ]);
    }

    /**
     * Get display version string for a rule version
     */
    private function getDisplayVersion($ruleVersion): string
    {
        if (! $ruleVersion) {
            return 'Base Rules';
        }

        $display = $ruleVersion->version_number;

        if ($ruleVersion->type === 'errata') {
            $display .= ' + Errata '.$ruleVersion->release_date->format('Y-m-d');
        } elseif ($ruleVersion->type === 'expansion') {
            $display .= ' + '.$ruleVersion->source_name;
        }

        return $display;
    }
}
