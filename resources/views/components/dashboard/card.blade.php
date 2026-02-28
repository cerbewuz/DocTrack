@props(['title', 'count', 'id', 'icon', 'color', 'route'])

@php
    $colors = [
        'blue' => ['bg' => 'bg-blue-50 dark:bg-blue-900/20', 'text' => 'text-blue-600 dark:text-blue-400', 'icon-bg' => 'bg-blue-100 dark:bg-blue-800/40'],
        'amber' => ['bg' => 'bg-amber-50 dark:bg-amber-900/20', 'text' => 'text-amber-600 dark:text-amber-400', 'icon-bg' => 'bg-amber-100 dark:bg-amber-800/40'],
        'green' => ['bg' => 'bg-green-50 dark:bg-green-900/20', 'text' => 'text-green-600 dark:text-green-400', 'icon-bg' => 'bg-green-100 dark:bg-green-800/40'],
        'rose' => ['bg' => 'bg-rose-50 dark:bg-rose-900/20', 'text' => 'text-rose-600 dark:text-rose-400', 'icon-bg' => 'bg-rose-100 dark:bg-rose-800/40'],
    ];
    $style = $colors[$color] ?? $colors['blue'];
@endphp

<a href="{{ route($route) }}" class="bg-white dark:bg-gray-800 rounded-xl p-3 shadow-sm border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-md hover:border-indigo-200 dark:hover:border-indigo-900 group block">
    <div class="flex flex-col items-center justify-center text-center">
        <!-- Compact Icon -->
        <div class="p-2 rounded-lg {{ $style['icon-bg'] }} {{ $style['text'] }} transition-transform duration-300 group-hover:scale-105 mb-2">
            <span class="material-symbols-outlined text-xl block">{{ $icon }}</span>
        </div>
        
        <!-- Compact Content -->
        <div class="w-full">
            <h3 class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-tighter mb-0.5 truncate">{{ $title }}</h3>
            <span class="text-xl font-black text-gray-900 dark:text-white leading-none block" id="{{ $id }}">{{ $count }}</span>
        </div>
    </div>
</a>
