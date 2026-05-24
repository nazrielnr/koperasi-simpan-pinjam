<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold tracking-tight text-zinc-950">Angsuran</h1>
                <p class="mt-1 text-xs leading-5 text-zinc-500">Kelola pembayaran angsuran, pokok, bunga, denda, dan status pembayaran.</p>
            </div>
            <button type="button" x-data x-on:click="$dispatch('open-modal', 'create-angsuran-modal')" class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-900 px-3 text-sm font-medium text-white transition hover:bg-zinc-800 active:scale-[0.98]">Tambah Angsuran</button>
        </div>
    </x-slot>

    <x-table-filters :filters="$filters" :sort-options="$sortOptions" placeholder="Cari pinjaman, anggota, nomor angsuran, nominal, tanggal, status, atau keterangan..." />

    <div class="overflow-x-auto border-y border-zinc-200/80">
        <table class="min-w-full text-left text-sm">
            <thead class="border-b border-zinc-200 text-[11px] uppercase tracking-wide text-zinc-400">
                <tr>
                    <th class="px-3 py-2 font-medium">Pinjaman</th>
                    <th class="px-3 py-2 font-medium">Angsuran</th>
                    <th class="px-3 py-2 font-medium">Bayar</th>
                    <th class="px-3 py-2 font-medium">Status</th>
                    <th class="px-3 py-2 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @forelse ($angsurans as $item)
                    <tr class="transition hover:bg-zinc-100/60">
                        <td class="px-3 py-3">
                            <div class="font-medium text-zinc-900">{{ $item->pinjaman?->nomor_pinjaman }}</div>
                            <div class="mt-0.5 text-xs text-zinc-400">{{ $item->pinjaman?->anggota?->nama }}</div>
                        </td>
                        <td class="px-3 py-3 text-zinc-600">#{{ $item->nomor_angsuran }}</td>
                        <td class="px-3 py-3 font-medium text-zinc-900">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="px-3 py-3 text-xs font-medium text-zinc-600">{{ ucfirst($item->status) }}</td>
                        <td class="px-3 py-3">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('angsuran.show', $item) }}" class="text-xs font-medium text-zinc-600 transition hover:text-zinc-950">Detail</a>
                                <a href="{{ route('angsuran.edit', $item) }}" class="text-xs font-medium text-zinc-600 transition hover:text-zinc-950">Edit</a>
                                <form method="POST" action="{{ route('angsuran.destroy', $item) }}" onsubmit="return confirm('Hapus data angsuran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs font-medium text-red-500 transition hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-10 text-center text-sm text-zinc-400">Belum ada data angsuran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $angsurans->links() }}</div>
    @include('components.create-modals', ['showAngsuran' => true, 'pinjamanOptions' => $pinjamanOptions])
    @include('components.edit-modals', ['editAngsurans' => $angsurans, 'pinjamanOptions' => $pinjamanOptions])
</x-app-layout>
