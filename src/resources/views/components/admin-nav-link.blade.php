@props(['active'])

@php
$classes = ($active ?? false)
? 'flex items-center px-4 py-2 mt-5 text-gray-700 bg-gray-200 rounded-md dark:bg-gray-700 dark:text-gray-200'
: 'flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>