@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-zinc-500 disabled:bg-zinc-50 disabled:text-zinc-500']) }}>
