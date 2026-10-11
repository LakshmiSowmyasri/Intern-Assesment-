<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseRequest;
use App\Http\Requests\UpdateCaseRequest;
use App\Models\MedicalCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CaseApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        Gate::authorize('viewAny', MedicalCase::class);

        $query = MedicalCase::with('creator')->latest();

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('priority')) {
            $query->byPriority($request->priority);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('case_number', 'like', "%{$search}%")
                    ->orWhere('patient_reference', 'like', "%{$search}%")
                    ->orWhere('surgeon_name', 'like', "%{$search}%")
                    ->orWhere('implant_type', 'like', "%{$search}%");
            });
        }

        $cases = $query->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $cases,
            'message' => 'Cases retrieved successfully.',
        ], 200);
    }

    public function store(StoreCaseRequest $request): JsonResponse
    {
        Gate::authorize('create', MedicalCase::class);

        $case = MedicalCase::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
        ]);

        $case->load('creator');

        return response()->json([
            'success' => true,
            'data' => $case,
            'message' => 'Case created successfully.',
        ], 201);
    }

    public function show(string $id): JsonResponse
    {
        $case = MedicalCase::with('creator')->find($id);

        if (! $case) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Case not found.',
            ], 404);
        }

        Gate::authorize('view', $case);

        return response()->json([
            'success' => true,
            'data' => $case,
            'message' => 'Case retrieved successfully.',
        ], 200);
    }

    public function update(UpdateCaseRequest $request, string $id): JsonResponse
    {
        $case = MedicalCase::find($id);

        if (! $case) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Case not found.',
            ], 404);
        }

        Gate::authorize('update', $case);

        $case->update($request->validated());
        $case->load('creator');

        return response()->json([
            'success' => true,
            'data' => $case,
            'message' => 'Case updated successfully.',
        ], 200);
    }

    public function destroy(string $id): JsonResponse
    {
        $case = MedicalCase::find($id);

        if (! $case) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Case not found.',
            ], 404);
        }

        Gate::authorize('delete', $case);

        $case->delete();

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Case deleted successfully.',
        ], 200);
    }
}
