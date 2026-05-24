<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 shadow-sm transition hover:bg-zinc-50 hover:text-zinc-900 active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-zinc-300 focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
