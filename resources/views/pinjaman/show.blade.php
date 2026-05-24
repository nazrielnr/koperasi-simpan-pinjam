<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Detail Pinjaman</h1>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Informasi lengkap pinjaman dan daftar angsuran terkait.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('pinjaman.index') }}" class="inline-flex h-9 items-center justify-center rounded-md border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Kembali</a>
                <a href="{{ route('pinjaman.edit', $pinjaman) }}" class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-900 px-3 text-sm font-medium text-white transition hover:bg-zinc-800">Edit</a>
            </div>
        </div>
    </x-slot>

    @php
        $pokokTerbayar = $pinjaman->angsuran->sum('pokok');
        $totalBayar = $pinjaman->angsuran->sum('jumlah_bayar');
        $sisaPokok = max(0, $pinjaman->jumlah_pokok - $pokokTerbayar);
    @endphp

    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Plafon</p>
            <p class="mt-2 text-2xl font-semibold text-zinc-950">Rp {{ number_format($pinjaman->jumlah_pokok, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Total Bayar</p>
            <p class="mt-2 text-2xl font-semibold text-zinc-950">Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Sisa Pokok</p>
            <p class="mt-2 text-2xl font-semibold text-zinc-950">Rp {{ number_format($sisaPokok, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
        <div class="flex flex-col gap-3 border-b border-zinc-100 pb-5 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Nomor Pinjaman</p>
                <h2 class="mt-1 text-xl font-semibold text-zinc-950">{{ $pinjaman->nomor_pinjaman }}</h2>
            </div>
            <span class="inline-flex w-fit rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-700">{{ ucfirst($pinjaman->status) }}</span>
        </div>

        <dl class="mt-6 grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Anggota</dt>
                <dd class="mt-1 text-sm font-medium text-zinc-900">
                    @if ($pinjaman->anggota)
                        <a href="{{ route('anggota.show', $pinjaman->anggota) }}" class="transition hover:text-zinc-600">{{ $pinjaman->anggota->nama }}</a>
                    @else
                        -
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Nomor Anggota</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $pinjaman->anggota?->nomor_anggota ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Bunga</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ number_format($pinjaman->bunga_persen, 2, ',', '.') }}%</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tenor</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $pinjaman->tenor_bulan }} bulan</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tanggal Cair</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $pinjaman->tanggal_cair?->format('d M Y') ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Jatuh Tempo</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $pinjaman->jatuh_tempo?->format('d M Y') ?: '-' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Keterangan</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $pinjaman->keterangan ?: '-' }}</dd>
            </div>
        </dl>
    </div>

    <div class="mt-6 rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-base font-semibold text-zinc-950">Daftar Angsuran</h2>
            <a href="{{ route('angsuran.create') }}" class="text-sm font-medium text-zinc-700 transition hover:text-zinc-950">Tambah Angsuran</a>
        </div>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="border-b border-zinc-200 text-[11px] uppercase tracking-wide text-zinc-400">
                    <tr>
                        <th class="py-2 pr-3 font-medium">Angsuran</th>
                        <th class="px-3 py-2 font-medium">Tanggal Bayar</th>
                        <th class="px-3 py-2 font-medium">Status</th>
                        <th class="py-2 pl-3 text-right font-medium">Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($pinjaman->angsuran as $angsuran)
                        <tr>
                            <td class="py-3 pr-3">
                                <a href="{{ route('angsuran.show', $angsuran) }}" class="font-medium text-zinc-900 transition hover:text-zinc-600">#{{ $angsuran->nomor_angsuran }}</a>
                                <div class="mt-0.5 text-xs text-zinc-400">Jatuh tempo {{ $angsuran->tanggal_jatuh_tempo?->format('d M Y') }}</div>
                            </td>
                            <td class="px-3 py-3 text-zinc-600">{{ $angsuran->tanggal_bayar?->format('d M Y') ?: '-' }}</td>
                            <td class="px-3 py-3 text-zinc-600">{{ ucfirst($angsuran->status) }}</td>
                            <td class="py-3 pl-3 text-right font-medium text-zinc-900">Rp {{ number_format($angsuran->jumlah_bayar, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-sm text-zinc-400">Belum ada angsuran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
