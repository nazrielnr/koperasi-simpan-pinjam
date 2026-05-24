<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl font-semibold tracking-tight text-zinc-950">Anggota</h1>
                <p class="mt-1 text-xs leading-5 text-zinc-500">Kelola identitas, kontak, status, dan tanggal gabung anggota koperasi.</p>
            </div>
            <button type="button" x-data x-on:click="$dispatch('open-modal', 'create-anggota-modal')" class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-900 px-3 text-sm font-medium text-white transition hover:bg-zinc-800 active:scale-[0.98]">Tambah Anggota</button>
        </div>
    </x-slot>

    <x-table-filters :filters="$filters" :sort-options="$sortOptions" placeholder="Cari nama, nomor anggota, NIK, telepon, alamat, atau status..." />

    <div class="overflow-x-auto border-y border-zinc-200/80">
        <table class="min-w-full text-left text-sm">
            <thead class="border-b border-zinc-200 text-[11px] uppercase tracking-wide text-zinc-400">
                <tr>
                    <th class="px-3 py-2 font-medium">No</th>
                    <th class="px-3 py-2 font-medium">Anggota</th>
                    <th class="px-3 py-2 font-medium">Kontak</th>
                    <th class="px-3 py-2 font-medium">Status</th>
                    <th class="px-3 py-2 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100">
                @forelse ($anggotas as $item)
                    <tr class="transition hover:bg-zinc-100/60">
                        <td class="px-3 py-3 text-zinc-400">{{ $anggotas->firstItem() + $loop->index }}</td>
                        <td class="px-3 py-3">
                            <div class="font-medium text-zinc-900">{{ $item->nama }}</div>
                            <div class="mt-0.5 text-xs text-zinc-400">{{ $item->nomor_anggota }} · {{ $item->tanggal_gabung?->format('d M Y') }}</div>
                        </td>
                        <td class="px-3 py-3 text-zinc-600">{{ $item->telepon ?? '-' }}</td>
                        <td class="px-3 py-3 text-xs font-medium text-zinc-600">{{ ucfirst($item->status) }}</td>
                        <td class="px-3 py-3">
                            <div class="flex items-center justify-end gap-3 whitespace-nowrap">
                                <button type="button" x-data x-on:click="$dispatch('open-slide-over', 'detail-anggota-{{ $item->id }}')" class="text-xs font-medium leading-none text-zinc-600 transition hover:text-zinc-950">Detail</button>
                                <form method="POST" action="{{ route('anggota.destroy', $item) }}" onsubmit="return confirm('Hapus data anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-medium leading-none text-red-500 transition hover:text-red-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-10 text-center text-sm text-zinc-400">Belum ada data anggota.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $anggotas->links() }}</div>

    @foreach ($anggotas as $item)
        <x-slide-over name="detail-anggota-{{ $item->id }}">
            <div class="flex items-start justify-between gap-4 border-b border-zinc-200 px-6 py-5">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">Detail Anggota</p>
                    <h2 class="mt-1 text-lg font-semibold text-zinc-950">{{ $item->nama }}</h2>
                    <p class="mt-1 text-sm text-zinc-500">{{ $item->nomor_anggota }}</p>
                </div>
                <button type="button" x-on:click="show = false" class="rounded-md p-2 text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-700">×</button>
            </div>

            <div class="flex-1 overflow-y-auto px-6 py-5">
                <dl class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Nomor Anggota</dt>
                        <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $item->nomor_anggota }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Status</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ ucfirst($item->status) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">NIK</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->nik ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Telepon</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->telepon ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Tanggal Gabung</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->tanggal_gabung?->format('d M Y') ?: '-' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-medium uppercase tracking-wide text-zinc-400">Alamat</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $item->alamat ?: '-' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="flex justify-end gap-3 border-t border-zinc-200 px-6 py-4">
                <button type="button" x-on:click="show = false" class="rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Tutup</button>
                <button type="button" x-on:click="show = false; $dispatch('open-modal', 'edit-anggota-{{ $item->id }}')" class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-800">Edit</button>
            </div>
        </x-slide-over>
    @endforeach

    @include('components.create-modals', ['showAnggota' => true])
    @include('components.edit-modals', ['editAnggotas' => $anggotas])
</x-app-layout>
