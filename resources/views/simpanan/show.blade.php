<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Detail Simpanan</h1>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Informasi lengkap transaksi simpanan anggota.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('simpanan.index') }}" class="inline-flex h-9 items-center justify-center rounded-md border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Kembali</a>
                <a href="{{ route('simpanan.edit', $simpanan) }}" class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-900 px-3 text-sm font-medium text-white transition hover:bg-zinc-800">Edit</a>
            </div>
        </div>
    </x-slot>

    <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
        <div class="flex flex-col gap-3 border-b border-zinc-100 pb-5 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Jumlah Simpanan</p>
                <p class="mt-2 text-3xl font-semibold text-zinc-950">Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</p>
            </div>
            <span class="inline-flex w-fit rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-700">{{ ucfirst($simpanan->jenis) }}</span>
        </div>

        <dl class="mt-6 grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Anggota</dt>
                <dd class="mt-1 text-sm font-medium text-zinc-900">
                    @if ($simpanan->anggota)
                        <a href="{{ route('anggota.show', $simpanan->anggota) }}" class="transition hover:text-zinc-600">{{ $simpanan->anggota->nama }}</a>
                    @else
                        -
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Nomor Anggota</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $simpanan->anggota?->nomor_anggota ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tanggal Transaksi</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $simpanan->tanggal_transaksi?->format('d M Y') ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Jenis</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ ucfirst($simpanan->jenis) }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Keterangan</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $simpanan->keterangan ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Dibuat</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $simpanan->created_at?->format('d M Y H:i') ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Terakhir Diperbarui</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $simpanan->updated_at?->format('d M Y H:i') ?: '-' }}</dd>
            </div>
        </dl>
    </div>
</x-app-layout>
