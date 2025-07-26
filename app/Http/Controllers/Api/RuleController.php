<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use App\Models\RuleVersion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    /**
     * List all rules with filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Rule::query()
            ->with(['rulePhase', 'keywords', 'versionEntries.ruleVersion'])
            ->where('is_searchable', true);

        // Filter by phase
        if ($request->has('phase')) {
            $query->whereHas('rulePhase', function (Builder $q) use ($request) {
                $q->where('slug', $request->phase);
            });
        }

        // Filter by version
        if ($request->has('version')) {
            $query->whereHas('versionEntries.ruleVersion', function (Builder $q) use ($request) {
                $q->where('version_number', $request->version);
            });
        }

        // Search by title or content
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description_markdown', 'like', "%{$searchTerm}%");
            });
        }

        $rules = $query->orderBy('title')->paginate(20);

        return response()->json([
            'data' => $rules->items(),
            'meta' => [
                'current_page' => $rules->currentPage(),
                'last_page' => $rules->lastPage(),
                'per_page' => $rules->perPage(),
                'total' => $rules->total(),
            ],
        ]);
    }

    /**
     * Get specific rule with relationships
     */
    public function show(string $slug): JsonResponse
    {
        $rule = Rule::where('slug', $slug)
            ->with([
                'rulePhase',
                'keywords',
                'versionEntries' => function ($query) {
                    $query->with('ruleVersion')->orderByDesc('created_at');
                },
                'referencedRules',
                'referencingRules',
            ])
            ->first();

        if (! $rule) {
            return response()->json([
                'error' => 'Rule not found',
            ], 404);
        }

        // Get version info
        $latestVersionEntry = $rule->versionEntries->first();
        $versionInfo = null;

        if ($latestVersionEntry) {
            $ruleVersion = $latestVersionEntry->ruleVersion;
            $versionInfo = [
                'display_version' => $this->getDisplayVersion($ruleVersion),
                'sources' => [$ruleVersion->source_name],
                'pdf_downloads' => $ruleVersion->pdf_url ? [$ruleVersion->pdf_url] : [],
            ];
        }

        return response()->json([
            'data' => [
                'rule' => $rule,
                'version_info' => $versionInfo,
                'relationships' => [
                    'keywords' => $rule->keywords,
                    'references' => [
                        'referenced_by_this_rule' => $rule->referencedRules,
                        'referencing_this_rule' => $rule->referencingRules,
                    ],
                ],
            ],
        ]);
    }

    /**
     * Search rules with advanced filtering
     */
    public function search(Request $request): JsonResponse
    {
        $query = Rule::query()
            ->with(['rulePhase', 'keywords', 'versionEntries.ruleVersion'])
            ->where('is_searchable', true);

        // Search query
        if ($request->has('q') && ! empty($request->q)) {
            $searchTerm = $request->q;
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description_markdown', 'like', "%{$searchTerm}%")
                    ->orWhereHas('keywords', function (Builder $keywordQuery) use ($searchTerm) {
                        $keywordQuery->where('name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        // Filter by phase
        if ($request->has('phase') && ! empty($request->phase)) {
            $query->whereHas('rulePhase', function (Builder $q) use ($request) {
                $q->where('slug', $request->phase);
            });
        }

        // Filter by version
        if ($request->has('version') && ! empty($request->version)) {
            $query->whereHas('versionEntries.ruleVersion', function (Builder $q) use ($request) {
                $q->where('version_number', $request->version);
            });
        }

        $rules = $query->orderBy('title')->paginate(20);

        return response()->json([
            'data' => $rules->items(),
            'meta' => [
                'current_page' => $rules->currentPage(),
                'last_page' => $rules->lastPage(),
                'per_page' => $rules->perPage(),
                'total' => $rules->total(),
                'search_params' => [
                    'query' => $request->q,
                    'phase' => $request->phase,
                    'version' => $request->version,
                ],
            ],
        ]);
    }

    /**
     * Get display version string for a rule version
     */
    private function getDisplayVersion(RuleVersion $ruleVersion): string
    {
        $display = $ruleVersion->version_number;

        if ($ruleVersion->type === 'errata') {
            $display .= ' + Errata '.$ruleVersion->release_date->format('Y-m-d');
        } elseif ($ruleVersion->type === 'expansion') {
            $display .= ' + '.$ruleVersion->source_name;
        }

        return $display;
    }
}
