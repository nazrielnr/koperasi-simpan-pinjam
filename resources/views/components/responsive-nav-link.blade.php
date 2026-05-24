@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-lg border border-zinc-900 bg-zinc-900 px-4 py-3 text-start text-base font-medium text-white shadow-sm transition duration-150 ease-in-out'
            : 'block w-full rounded-lg border border-transparent px-4 py-3 text-start text-base font-medium text-zinc-600 transition duration-150 ease-in-out hover:border-zinc-200 hover:bg-zinc-50 hover:text-zinc-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
