<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * List equipment with filtering
     */
    public function index(Request $request): JsonResponse
    {
        $query = Equipment::query()
            ->with(['category', 'keywords', 'constraints.constraintType']);

        // Filter by equipment type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        // Filter by cost range
        if ($request->has('min_cost')) {
            $query->where('cost_ducats', '>=', $request->min_cost);
        }
        if ($request->has('max_cost')) {
            $query->where('cost_ducats', '<=', $request->max_cost);
        }

        // Search by name or description
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function (Builder $q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description_markdown', 'like', "%{$searchTerm}%")
                    ->orWhere('special_rules', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by keyword
        if ($request->has('keyword')) {
            $query->whereHas('keywords', function (Builder $q) use ($request) {
                $q->where('name', 'like', "%{$request->keyword}%");
            });
        }

        // Filter by availability (unique, limited, etc.)
        if ($request->has('unique')) {
            $query->where('is_unique', $request->boolean('unique'));
        }

        $equipment = $query->orderBy('name')->paginate(20);

        return response()->json([
            'data' => $equipment->items(),
            'meta' => [
                'current_page' => $equipment->currentPage(),
                'last_page' => $equipment->lastPage(),
                'per_page' => $equipment->perPage(),
                'total' => $equipment->total(),
            ],
        ]);
    }

    /**
     * Get equipment with constraints and rules
     */
    public function show(int $id): JsonResponse
    {
        $equipment = Equipment::with([
            'category',
            'keywords',
            'constraints' => function ($query) {
                $query->with('constraintType');
            },
        ])
            ->find($id);

        if (! $equipment) {
            return response()->json([
                'error' => 'Equipment not found',
            ], 404);
        }

        // Get related rules through keywords
        $relatedRules = collect();
        foreach ($equipment->keywords as $keyword) {
            $keywordRules = $keyword->rules()->where('is_searchable', true)->with('rulePhase')->get();
            $relatedRules = $relatedRules->merge($keywordRules);
        }
        $relatedRules = $relatedRules->unique('id');

        // Format constraints for easier consumption
        $formattedConstraints = $equipment->constraints->map(function ($constraint) {
            return [
                'id' => $constraint->id,
                'type' => $constraint->constraintType->name,
                'scope' => $constraint->constraintType->scope,
                'description' => $constraint->description_markdown,
                'conditions' => $constraint->conditions,
                'is_restriction' => $constraint->is_restriction,
                'applies_to' => $constraint->applies_to,
            ];
        });

        return response()->json([
            'data' => [
                'equipment' => [
                    'id' => $equipment->id,
                    'name' => $equipment->name,
                    'slug' => $equipment->slug,
                    'description_markdown' => $equipment->description_markdown,
                    'special_rules' => $equipment->special_rules,
                    'cost_ducats' => $equipment->cost_ducats,
                    'is_unique' => $equipment->is_unique,
                    'is_limited' => $equipment->is_limited,
                    'limit_per_warband' => $equipment->limit_per_warband,
                    'category' => $equipment->category,
                    'created_at' => $equipment->created_at,
                    'updated_at' => $equipment->updated_at,
                ],
                'version_info' => [
                    'display_version' => 'Base Rules', // Equipment doesn't have version entries like rules/keywords
                    'sources' => ['Core Rules'],
                    'pdf_downloads' => [],
                ],
                'relationships' => [
                    'keywords' => $equipment->keywords,
                    'related_rules' => $relatedRules->values(),
                    'constraints' => $formattedConstraints,
                ],
                'usage_info' => [
                    'can_be_taken_multiple_times' => ! $equipment->is_unique && ! $equipment->is_limited,
                    'warband_limit' => $equipment->limit_per_warband,
                    'restrictions' => $formattedConstraints->where('is_restriction', true)->values(),
                    'requirements' => $formattedConstraints->where('is_restriction', false)->values(),
                ],
            ],
        ]);
    }
}
