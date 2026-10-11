<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('cases.index') }}" class="text-gray-500 hover:text-gray-700 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $case->case_number }}</h2>
                <p class="text-sm text-gray-500">Created by {{ $case->creator?->name ?? 'Unknown' }} on {{ $case->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Flash --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Detail Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        @include('cases._status_badge', ['status' => $case->status])
                        @include('cases._priority_badge', ['priority' => $case->priority])
                    </div>
                    <div class="flex items-center gap-3">
                        @can('update', $case)
                            <a href="{{ route('cases.edit', $case) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50 transition">
                                Edit
                            </a>
                        @endcan
                        @can('delete', $case)
                            <form method="POST" action="{{ route('cases.destroy', $case) }}" onsubmit="return confirm('Delete this case?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-red-300 rounded-md text-sm text-red-600 bg-white hover:bg-red-50 transition">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                <dl class="divide-y divide-gray-100">
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Case Number</dt>
                        <dd class="text-sm text-gray-900 col-span-2 font-mono">{{ $case->case_number }}</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Patient Reference</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $case->patient_reference }}</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Surgeon</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $case->surgeon_name }}</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Implant Type</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $case->implant_type }}</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Surgery Date</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $case->surgery_date?->format('d M Y') ?? '—' }}</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Created By</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $case->creator?->name ?? 'Unknown' }} ({{ $case->creator?->email ?? 'N/A' }})</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Created At</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $case->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-3 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="text-sm text-gray-900 col-span-2">{{ $case->updated_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex">
                <a href="{{ route('cases.index') }}" class="text-sm text-indigo-600 hover:underline">← Back to all cases</a>
            </div>
        </div>
    </div>
</x-app-layout>
