<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Detail Angsuran</h1>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Informasi lengkap pembayaran angsuran pinjaman.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('angsuran.index') }}" class="inline-flex h-9 items-center justify-center rounded-md border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Kembali</a>
                <a href="{{ route('angsuran.edit', $angsuran) }}" class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-900 px-3 text-sm font-medium text-white transition hover:bg-zinc-800">Edit</a>
            </div>
        </div>
    </x-slot>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Jumlah Bayar</p>
            <p class="mt-2 text-xl font-semibold text-zinc-950">Rp {{ number_format($angsuran->jumlah_bayar, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Pokok</p>
            <p class="mt-2 text-xl font-semibold text-zinc-950">Rp {{ number_format($angsuran->pokok, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Bunga</p>
            <p class="mt-2 text-xl font-semibold text-zinc-950">Rp {{ number_format($angsuran->bunga, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Denda</p>
            <p class="mt-2 text-xl font-semibold text-zinc-950">Rp {{ number_format($angsuran->denda, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
        <div class="flex flex-col gap-3 border-b border-zinc-100 pb-5 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Nomor Angsuran</p>
                <h2 class="mt-1 text-xl font-semibold text-zinc-950">#{{ $angsuran->nomor_angsuran }}</h2>
            </div>
            <span class="inline-flex w-fit rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-700">{{ ucfirst($angsuran->status) }}</span>
        </div>

        <dl class="mt-6 grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Pinjaman</dt>
                <dd class="mt-1 text-sm font-medium text-zinc-900">
                    @if ($angsuran->pinjaman)
                        <a href="{{ route('pinjaman.show', $angsuran->pinjaman) }}" class="transition hover:text-zinc-600">{{ $angsuran->pinjaman->nomor_pinjaman }}</a>
                    @else
                        -
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Anggota</dt>
                <dd class="mt-1 text-sm text-zinc-700">
                    @if ($angsuran->pinjaman?->anggota)
                        <a href="{{ route('anggota.show', $angsuran->pinjaman->anggota) }}" class="transition hover:text-zinc-600">{{ $angsuran->pinjaman->anggota->nama }}</a>
                    @else
                        -
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tanggal Jatuh Tempo</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $angsuran->tanggal_jatuh_tempo?->format('d M Y') ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tanggal Bayar</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $angsuran->tanggal_bayar?->format('d M Y') ?: '-' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Keterangan</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $angsuran->keterangan ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Dibuat</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $angsuran->created_at?->format('d M Y H:i') ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Terakhir Diperbarui</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $angsuran->updated_at?->format('d M Y H:i') ?: '-' }}</dd>
            </div>
        </dl>
    </div>
</x-app-layout>
