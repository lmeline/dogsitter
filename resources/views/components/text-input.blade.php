@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block mt-1 w-full rounded border border-red-300 focus:ring-red-500 focus:border-red-500 dark:bg-white dark:text-black']) }}>
