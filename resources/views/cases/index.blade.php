<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Medical Cases
            </h2>
            @can('create', App\Models\MedicalCase::class)
                <a href="{{ route('cases.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    + New Case
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Stats (Assignment: Total cases, Planning, In Review, Approved, Completed) --}}
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                @foreach ([
                    ['label' => 'Total Cases', 'value' => $stats['total'], 'color' => 'bg-gray-100 text-gray-800'],
                    ['label' => 'Planning', 'value' => $stats['planning'], 'color' => 'bg-yellow-100 text-yellow-800'],
                    ['label' => 'In Review', 'value' => $stats['in_review'], 'color' => 'bg-blue-100 text-blue-800'],
                    ['label' => 'Approved', 'value' => $stats['approved'], 'color' => 'bg-purple-100 text-purple-800'],
                    ['label' => 'Completed', 'value' => $stats['completed'], 'color' => 'bg-green-100 text-green-800'],
                ] as $stat)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $stat['value'] }}</div>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $stat['color'] }}">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Filters --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-4">
                    <form method="GET" action="{{ route('cases.index') }}" class="flex flex-wrap gap-3 items-end">
                        <div class="flex-1 min-w-[200px]">
                            <label for="search" class="block text-xs font-medium text-gray-600 mb-1">Search (Case # or Surgeon Name)</label>
                            <input
                                id="search"
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search by case number or surgeon name…"
                                class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500"
                            >
                        </div>
                        <div>
                            <label for="status" class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                            <select id="status" name="status" class="border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Statuses</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="priority" class="block text-xs font-medium text-gray-600 mb-1">Priority</label>
                            <select id="priority" name="priority" class="border-gray-300 rounded-md shadow-sm text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Priorities</option>
                                @foreach ($priorities as $priority)
                                    <option value="{{ $priority }}" @selected(request('priority') === $priority)>{{ $priority }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700 transition">
                            Filter
                        </button>
                        @if (request()->hasAny(['search', 'status', 'priority']))
                            <a href="{{ route('cases.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 text-sm rounded-md hover:bg-gray-200 transition">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            {{-- Cases Table --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                @if ($cases->isEmpty())
                    <div class="p-12 text-center text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-sm font-medium">No cases found</p>
                        @can('create', App\Models\MedicalCase::class)
                            <p class="text-xs mt-1">Get started by <a href="{{ route('cases.create') }}" class="text-indigo-600 hover:underline">creating a new case</a>.</p>
                        @endcan
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Case #</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Patient Ref</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Surgeon</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Implant</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Priority</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Surgery Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($cases as $case)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 font-medium text-indigo-600">
                                            <a href="{{ route('cases.show', $case) }}" class="hover:underline">{{ $case->case_number }}</a>
                                        </td>
                                        <td class="px-4 py-3 text-gray-700">{{ $case->patient_reference }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $case->surgeon_name }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $case->implant_type }}</td>
                                        <td class="px-4 py-3">
                                            @include('cases._status_badge', ['status' => $case->status])
                                        </td>
                                        <td class="px-4 py-3">
                                            @include('cases._priority_badge', ['priority' => $case->priority])
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $case->surgery_date?->format('d M Y') ?? '—' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('cases.show', $case) }}" class="text-gray-500 hover:text-indigo-600 transition" title="View details">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                </a>
                                                @can('update', $case)
                                                    <a href="{{ route('cases.edit', $case) }}" class="text-gray-500 hover:text-indigo-600 transition" title="Edit">
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                                    </a>
                                                @endcan
                                                @can('delete', $case)
                                                    <form method="POST" action="{{ route('cases.destroy', $case) }}" onsubmit="return confirm('Delete case {{ $case->case_number }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-gray-500 hover:text-red-600 transition" title="Delete">
                                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($cases->hasPages())
                        <div class="px-4 py-3 border-t border-gray-200">
                            {{ $cases->links() }}
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
