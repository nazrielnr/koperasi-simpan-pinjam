<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Edit Anggota</h1>
            <p class="mt-1 text-sm leading-6 text-zinc-500">Perbarui identitas, kontak, dan status anggota yang sudah tersimpan.</p>
        </div>
    </x-slot>

    <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
        <form method="POST" action="{{ route('anggota.update', $anggota) }}">
            @method('PUT')
            @include('anggota._form', ['anggota' => $anggota])
        </form>
    </div>
</x-app-layout>
