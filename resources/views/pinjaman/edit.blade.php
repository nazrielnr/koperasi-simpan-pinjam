<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Edit Pinjaman</h1>
            <p class="mt-1 text-sm leading-6 text-zinc-500">Perbarui data pinjaman dan status pencairan yang sudah tersimpan.</p>
        </div>
    </x-slot>

    <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
        <form method="POST" action="{{ route('pinjaman.update', $pinjaman) }}">
            @method('PUT')
            @include('pinjaman._form', ['pinjaman' => $pinjaman, 'anggotas' => $anggotas])
        </form>
    </div>
</x-app-layout>
