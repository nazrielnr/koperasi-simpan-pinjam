<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Detail Anggota</h1>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Informasi lengkap anggota, simpanan, dan pinjaman terkait.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('anggota.index') }}" class="inline-flex h-9 items-center justify-center rounded-md border border-zinc-200 bg-white px-3 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Kembali</a>
                <a href="{{ route('anggota.edit', $anggota) }}" class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-900 px-3 text-sm font-medium text-white transition hover:bg-zinc-800">Edit</a>
            </div>
        </div>
    </x-slot>

    @php
        $totalSimpanan = $anggota->simpanan->sum('jumlah');
        $totalPinjaman = $anggota->pinjaman->sum('jumlah_pokok');
        $totalPokokTerbayar = $anggota->pinjaman->sum(fn ($pinjaman) => $pinjaman->angsuran->sum('pokok'));
    @endphp

    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Total Simpanan</p>
            <p class="mt-2 text-2xl font-semibold text-zinc-950">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Total Pinjaman</p>
            <p class="mt-2 text-2xl font-semibold text-zinc-950">Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
            <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Sisa Pokok</p>
            <p class="mt-2 text-2xl font-semibold text-zinc-950">Rp {{ number_format(max(0, $totalPinjaman - $totalPokokTerbayar), 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mt-6 rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
        <h2 class="text-base font-semibold text-zinc-950">Data Anggota</h2>
        <dl class="mt-5 grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Nomor Anggota</dt>
                <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $anggota->nomor_anggota }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Nama</dt>
                <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $anggota->nama }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">NIK</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $anggota->nik ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Telepon</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $anggota->telepon ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tanggal Gabung</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $anggota->tanggal_gabung?->format('d M Y') ?: '-' }}</dd>
            </div>
            <div>
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Status</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ ucfirst($anggota->status) }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Alamat</dt>
                <dd class="mt-1 text-sm text-zinc-700">{{ $anggota->alamat ?: '-' }}</dd>
            </div>
        </dl>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="text-base font-semibold text-zinc-950">Riwayat Simpanan</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="border-b border-zinc-200 text-[11px] uppercase tracking-wide text-zinc-400">
                        <tr>
                            <th class="py-2 pr-3 font-medium">Tanggal</th>
                            <th class="px-3 py-2 font-medium">Jenis</th>
                            <th class="py-2 pl-3 text-right font-medium">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse ($anggota->simpanan as $simpanan)
                            <tr>
                                <td class="py-3 pr-3 text-zinc-600">{{ $simpanan->tanggal_transaksi?->format('d M Y') }}</td>
                                <td class="px-3 py-3 text-zinc-600">{{ ucfirst($simpanan->jenis) }}</td>
                                <td class="py-3 pl-3 text-right font-medium text-zinc-900">Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-sm text-zinc-400">Belum ada simpanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
            <h2 class="text-base font-semibold text-zinc-950">Riwayat Pinjaman</h2>
            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="border-b border-zinc-200 text-[11px] uppercase tracking-wide text-zinc-400">
                        <tr>
                            <th class="py-2 pr-3 font-medium">Nomor</th>
                            <th class="px-3 py-2 font-medium">Status</th>
                            <th class="py-2 pl-3 text-right font-medium">Plafon</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse ($anggota->pinjaman as $pinjaman)
                            <tr>
                                <td class="py-3 pr-3">
                                    <a href="{{ route('pinjaman.show', $pinjaman) }}" class="font-medium text-zinc-900 transition hover:text-zinc-600">{{ $pinjaman->nomor_pinjaman }}</a>
                                    <div class="mt-0.5 text-xs text-zinc-400">{{ $pinjaman->tanggal_cair?->format('d M Y') }}</div>
                                </td>
                                <td class="px-3 py-3 text-zinc-600">{{ ucfirst($pinjaman->status) }}</td>
                                <td class="py-3 pl-3 text-right font-medium text-zinc-900">Rp {{ number_format($pinjaman->jumlah_pokok, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-8 text-center text-sm text-zinc-400">Belum ada pinjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
