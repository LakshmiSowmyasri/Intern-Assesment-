<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaseRequest;
use App\Http\Requests\UpdateCaseRequest;
use App\Models\MedicalCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CaseController extends Controller
{
    public function index(Request $request): View
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

        // Assignment requirement: 10 per page
        $cases = $query->paginate(10)->withQueryString();

        // Assignment requirement: counts for Total cases, Planning, In Review, Approved, Completed
        $stats = [
            'total' => MedicalCase::count(),
            'planning' => MedicalCase::byStatus('Planning')->count(),
            'in_review' => MedicalCase::byStatus('In Review')->count(),
            'approved' => MedicalCase::byStatus('Approved')->count(),
            'completed' => MedicalCase::byStatus('Completed')->count(),
        ];

        return view('cases.index', [
            'cases' => $cases,
            'stats' => $stats,
            'statuses' => MedicalCase::statuses(),
            'priorities' => MedicalCase::priorities(),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', MedicalCase::class);

        return view('cases.create', [
            'statuses' => MedicalCase::statuses(),
            'priorities' => MedicalCase::priorities(),
            'caseNumber' => MedicalCase::generateCaseNumber(),
        ]);
    }

    public function store(StoreCaseRequest $request): RedirectResponse
    {
        Gate::authorize('create', MedicalCase::class);

        $case = MedicalCase::create([
            ...$request->validated(),
            'created_by' => $request->user()->id,
        ]);

        return redirect()->route('cases.show', $case)
            ->with('success', "Case {$case->case_number} created successfully.");
    }

    public function show(MedicalCase $case): View
    {
        Gate::authorize('view', $case);

        $case->load('creator');

        return view('cases.show', compact('case'));
    }

    public function edit(MedicalCase $case): View
    {
        Gate::authorize('update', $case);

        return view('cases.edit', [
            'case' => $case,
            'statuses' => MedicalCase::statuses(),
            'priorities' => MedicalCase::priorities(),
        ]);
    }

    public function update(UpdateCaseRequest $request, MedicalCase $case): RedirectResponse
    {
        Gate::authorize('update', $case);

        $case->update($request->validated());

        return redirect()->route('cases.show', $case)
            ->with('success', "Case {$case->case_number} updated successfully.");
    }

    public function destroy(MedicalCase $case): RedirectResponse
    {
        Gate::authorize('delete', $case);

        $caseNumber = $case->case_number;
        $case->delete();

        return redirect()->route('cases.index')
            ->with('success', "Case {$caseNumber} deleted successfully.");
    }
}
