@php
    $colors = [
        'Draft'     => 'bg-gray-100 text-gray-700',
        'Planning'  => 'bg-yellow-100 text-yellow-800',
        'In Review' => 'bg-blue-100 text-blue-800',
        'Approved'  => 'bg-purple-100 text-purple-800',
        'Completed' => 'bg-green-100 text-green-800',
        'Cancelled' => 'bg-red-100 text-red-700',
    ];
    $color = $colors[$status] ?? 'bg-gray-100 text-gray-700';
@endphp
<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $color }}">
    {{ $status }}
</span>
