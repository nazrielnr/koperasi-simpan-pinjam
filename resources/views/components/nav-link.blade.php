@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-lg border border-zinc-900 bg-zinc-900 px-3 py-2 text-sm font-medium leading-5 text-white shadow-sm transition duration-150 ease-in-out'
            : 'inline-flex items-center rounded-lg border border-transparent px-3 py-2 text-sm font-medium leading-5 text-zinc-500 transition duration-150 ease-in-out hover:border-zinc-200 hover:bg-zinc-50 hover:text-zinc-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
