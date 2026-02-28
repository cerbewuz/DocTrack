@props(['disabled' => false, 'value' => ''])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-2xl text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:text-gray-200 transition-all']) !!}
       value="{{ $value }}">
