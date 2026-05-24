<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold tracking-tight text-zinc-950">Pinjaman</h1>
                <p class="mt-1 text-xs leading-5 text-zinc-500">Kelola pengajuan, plafon, pencairan, dan status pinjaman anggota.</p>
            </div>
            <button type="button" x-data x-on:click="$dispatch('open-modal', 'create-pinjaman-modal')" class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-900 px-3 text-sm font-medium text-white transition hover:bg-zinc-800 active:scale-[0.98]">Tambah Pinjaman</button>
        </div>
    </x-slot>

    <x-table-filters :filters="$filters" :sort-options="$sortOptions" placeholder="Cari nomor pinjaman, anggota, plafon, bunga, tenor, status, atau keterangan..." />

    <div class="overflow-x-auto border-y border-zinc-200/80">
        <table class="min-w-full text-left text-sm">
            <thead class="border-b border-zinc-200 text-[11px] uppercase tracking-wide text-zinc-400">
                <tr>
                    <th class="px-3 py-2 font-medium">Nomor</th>
                    <th class="px-3 py-2 font-medium">Anggota</th>
                    <th class="px-3 py-2 font-medium">Plafon</th>
                    <th class="px-3 py-2 font-medium">Status</th>
                    <th class="px-3 py-2 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @forelse ($pinjamans as $item)
                    <tr class="transition hover:bg-zinc-100/60">
                        <td class="px-3 py-3">
                            <div class="font-medium text-zinc-900">{{ $item->nomor_pinjaman }}</div>
                            <div class="mt-0.5 text-xs text-zinc-400">Cair {{ $item->tanggal_cair?->format('d M Y') }}</div>
                        </td>
                        <td class="px-3 py-3 text-zinc-600">{{ $item->anggota?->nama }}</td>
                        <td class="px-3 py-3">
                            <div class="font-medium text-zinc-900">Rp {{ number_format($item->jumlah_pokok, 0, ',', '.') }}</div>
                            <div class="mt-0.5 text-xs text-zinc-400">Sisa Rp {{ number_format(max(0, $item->jumlah_pokok - ($item->pokok_terbayar ?? 0)), 0, ',', '.') }}</div>
                        </td>
                        <td class="px-3 py-3 text-xs font-medium text-zinc-600">{{ ucfirst($item->status) }}</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center justify-end gap-3 whitespace-nowrap">
                                <button type="button" x-data x-on:click="$dispatch('open-slide-over', 'detail-pinjaman-{{ $item->id }}')" class="text-xs font-medium leading-none text-zinc-600 transition hover:text-zinc-950">Detail</button>
                                <form method="POST" action="{{ route('pinjaman.destroy', $item) }}" onsubmit="return confirm('Hapus data pinjaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-medium leading-none text-red-500 transition hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-10 text-center text-sm text-zinc-400">Belum ada data pinjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $pinjamans->links() }}</div>

    @foreach ($pinjamans as $item)
        <x-slide-over name="detail-pinjaman-{{ $item->id }}">
            <div class="flex items-start justify-between gap-4 border-b border-zinc-200 px-6 py-5">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Detail Pinjaman</p>
                    <h2 class="mt-1 text-lg font-semibold text-zinc-950">{{ $item->nomor_pinjaman }}</h2>
                    <p class="mt-1 text-sm text-zinc-500">{{ $item->anggota?->nama ?: '-' }} · {{ ucfirst($item->status) }}</p>
                </div>
                <button type="button" x-on:click="show = false" class="rounded-md p-2 text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-700">×</button>
            </div>

            <div class="flex-1 overflow-y-auto px-6 py-5">
                <dl class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Anggota</dt>
                        <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $item->anggota?->nama ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Status</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ ucfirst($item->status) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Plafon</dt>
                        <dd class="mt-1 text-sm font-medium text-zinc-900">Rp {{ number_format($item->jumlah_pokok, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Sisa Pokok</dt>
                        <dd class="mt-1 text-sm text-zinc-700">Rp {{ number_format(max(0, $item->jumlah_pokok - ($item->pokok_terbayar ?? 0)), 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Bunga</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->bunga_persen }}%</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tenor</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->tenor_bulan }} bulan</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tanggal Cair</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->tanggal_cair?->format('d M Y') ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Jatuh Tempo</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->jatuh_tempo?->format('d M Y') ?: '-' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Keterangan</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->keterangan ?: '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex justify-end gap-3 border-t border-zinc-200 px-6 py-4">
                <button type="button" x-on:click="show = false" class="rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Tutup</button>
                <button type="button" x-on:click="show = false; $dispatch('open-modal', 'edit-pinjaman-{{ $item->id }}')" class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-800">Edit</button>
            </div>
        </x-slide-over>
    @endforeach

    @include('components.create-modals', ['showPinjaman' => true, 'anggotaOptions' => $anggotaOptions])
    @include('components.edit-modals', ['editPinjamans' => $pinjamans, 'anggotaOptions' => $anggotaOptions])
</x-app-layout>
