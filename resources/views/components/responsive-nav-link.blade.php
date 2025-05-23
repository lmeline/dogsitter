@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-rose-400 dark:border-rose-600 text-start text-base font-medium text-rose-700 dark:text-rose-800 bg-rose-50 dark:bg-rose-900/50 focus:outline-none focus:text-rose-800 dark:focus:text-rose-200 focus:bg-rose-100 dark:focus:bg-rose-900 focus:border-rose-700 dark:focus:border-rose-300 transition duration-150 ease-in-out'
            
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-500 focus:outline-none focus:text-orange-800 dark:focus:text-orange-200 focus:bg-orange-50 dark:focus:bg-orange-700 focus:border-orange-300 dark:focus:border-orange-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
