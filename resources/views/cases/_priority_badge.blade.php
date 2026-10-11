@php
    $colors = [
        'Low'    => 'bg-gray-100 text-gray-600',
        'Medium' => 'bg-orange-100 text-orange-700',
        'High'   => 'bg-red-100 text-red-700',
    ];
    $color = $colors[$priority] ?? 'bg-gray-100 text-gray-600';
@endphp
<span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $color }}">
    {{ $priority }}
</span>
