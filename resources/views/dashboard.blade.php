<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Dashboard</h1>
            <p class="mt-1 text-sm leading-6 text-zinc-500">Ringkasan kondisi koperasi dan aktivitas terbaru.</p>
        </div>
    </x-slot>

    <div x-data="{ actionModal: false }" class="space-y-6">
        {{-- Overview / page action --}}
        <section class="flex flex-col gap-4 rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div class="max-w-2xl">

                <h2 class="text-2xl font-semibold tracking-tight text-zinc-950">Pantau data utama tanpa distraksi.</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-500">
                    Fokus pada angka penting, data terbaru, dan akses input yang dipindah ke dialog agar halaman tetap rapi.
                </p>
            </div>

            <button type="button" @click="actionModal = true"
                class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-zinc-800 active:scale-[0.98]">
                Tambah Data
            </button>
        </section>

        {{-- KPI --}}
        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Anggota</p>
                        <p class="mt-3 text-3xl font-semibold tracking-tight text-zinc-950">{{ $totalAnggota }}</p>
                    </div>
                    <span class="rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-1 text-xs text-zinc-500">Data</span>
                </div>
                <div class="mt-5 h-1.5 rounded-full bg-zinc-100">
                    <div class="h-1.5 w-full rounded-full bg-zinc-700"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Anggota Aktif</p>
                        <p class="mt-3 text-3xl font-semibold tracking-tight text-zinc-950">{{ $anggotaAktif }}</p>
                    </div>
                    <span class="rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-1 text-xs text-zinc-500">Aktif</span>
                </div>
                <div class="mt-5 h-1.5 rounded-full bg-zinc-100">
                    <div class="h-1.5 rounded-full bg-zinc-700" style="width: {{ $totalAnggota > 0 ? min(100, round(($anggotaAktif / $totalAnggota) * 100)) : 0 }}%"></div>
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Simpanan</p>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-zinc-950">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</p>
                    </div>
                    <span class="rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-1 text-xs text-zinc-500">Masuk</span>
                </div>
                <p class="mt-5 text-xs leading-5 text-zinc-400">Akumulasi seluruh simpanan yang tercatat.</p>
            </div>

            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Outstanding</p>
                        <p class="mt-3 text-2xl font-semibold tracking-tight text-zinc-950">Rp {{ number_format($outstanding, 0, ',', '.') }}</p>
                    </div>
                    <span class="rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-1 text-xs text-zinc-500">Piutang</span>
                </div>
                <p class="mt-5 text-xs leading-5 text-zinc-400">Sisa pokok pinjaman yang belum selesai.</p>
            </div>
        </section>

        {{-- Recent data --}}
        <section class="grid gap-6 xl:grid-cols-2">
            <div class="rounded-2xl border border-zinc-200/80 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-5 py-4">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">Anggota Terbaru</h3>
                        <p class="mt-0.5 text-xs text-zinc-400">Lima data terakhir</p>
                    </div>
                    <a href="{{ route('anggota.index') }}" class="text-xs font-medium text-zinc-500 transition hover:text-zinc-900">Lihat semua</a>
                </div>

                <div class="divide-y divide-zinc-100">
                    @forelse ($recentAnggota as $item)
                        <div class="flex items-center justify-between gap-4 px-5 py-3.5">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-zinc-900">{{ $item->nama }}</p>
                                <p class="mt-0.5 truncate text-xs text-zinc-400">{{ $item->nomor_anggota }} · {{ $item->tanggal_gabung?->format('d M Y') }}</p>
                            </div>
                            <span class="shrink-0 rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-1 text-xs text-zinc-500">{{ $item->status }}</span>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-zinc-400">Belum ada data anggota.</div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200/80 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-5 py-4">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">Pinjaman Terbaru</h3>
                        <p class="mt-0.5 text-xs text-zinc-400">Ringkasan pinjaman terakhir</p>
                    </div>
                    <a href="{{ route('pinjaman.index') }}" class="text-xs font-medium text-zinc-500 transition hover:text-zinc-900">Lihat semua</a>
                </div>

                <div class="divide-y divide-zinc-100">
                    @forelse ($recentPinjaman as $item)
                        <div class="flex items-center justify-between gap-4 px-5 py-3.5">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-zinc-900">{{ $item->nomor_pinjaman }}</p>
                                <p class="mt-0.5 truncate text-xs text-zinc-400">{{ $item->anggota?->nama }} · {{ $item->status }}</p>
                            </div>
                            <div class="shrink-0 text-right">
                                <p class="text-sm font-semibold text-zinc-900">Rp {{ number_format($item->jumlah_pokok, 0, ',', '.') }}</p>
                                <p class="mt-0.5 text-xs text-zinc-400">Sisa Rp {{ number_format(max(0, $item->jumlah_pokok - ($item->pokok_terbayar ?? 0)), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-zinc-400">Belum ada data pinjaman.</div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200/80 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-5 py-4">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">Simpanan Terbaru</h3>
                        <p class="mt-0.5 text-xs text-zinc-400">Transaksi simpanan terakhir</p>
                    </div>
                    <a href="{{ route('simpanan.index') }}" class="text-xs font-medium text-zinc-500 transition hover:text-zinc-900">Lihat semua</a>
                </div>

                <div class="divide-y divide-zinc-100">
                    @forelse ($recentSimpanan as $item)
                        <div class="flex items-center justify-between gap-4 px-5 py-3.5">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-zinc-900">{{ $item->anggota?->nama }}</p>
                                <p class="mt-0.5 truncate text-xs text-zinc-400">{{ ucfirst($item->jenis) }} · {{ $item->tanggal_transaksi?->format('d M Y') }}</p>
                            </div>
                            <p class="shrink-0 text-sm font-semibold text-zinc-900">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-zinc-400">Belum ada data simpanan.</div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-2xl border border-zinc-200/80 bg-white shadow-sm">
                <div class="flex items-center justify-between border-b border-zinc-100 px-5 py-4">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">Angsuran Terbaru</h3>
                        <p class="mt-0.5 text-xs text-zinc-400">Pembayaran terakhir</p>
                    </div>
                    <a href="{{ route('angsuran.index') }}" class="text-xs font-medium text-zinc-500 transition hover:text-zinc-900">Lihat semua</a>
                </div>

                <div class="divide-y divide-zinc-100">
                    @forelse ($recentAngsuran as $item)
                        <div class="flex items-center justify-between gap-4 px-5 py-3.5">
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-zinc-900">{{ $item->pinjaman?->nomor_pinjaman }}</p>
                                <p class="mt-0.5 truncate text-xs text-zinc-400">{{ $item->pinjaman?->anggota?->nama }} · {{ $item->status }}</p>
                            </div>
                            <div class="shrink-0 text-right">
                                <p class="text-sm font-semibold text-zinc-900">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</p>
                                <p class="mt-0.5 text-xs text-zinc-400">{{ $item->tanggal_bayar?->format('d M Y') ?? '-' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-10 text-center text-sm text-zinc-400">Belum ada data angsuran.</div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Action modal --}}
        <div x-cloak x-show="actionModal" class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true" role="dialog">
            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="actionModal"
                    x-transition.opacity.duration.200ms
                    class="fixed inset-0 bg-zinc-950/35 backdrop-blur-[2px]"
                    @click="actionModal = false"></div>

                <div x-show="actionModal"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-3 scale-95"
                    @keydown.escape.window="actionModal = false"
                    class="relative w-full max-w-lg rounded-2xl border border-zinc-200 bg-white shadow-2xl shadow-zinc-950/10">
                    <div class="flex items-start justify-between gap-4 border-b border-zinc-100 px-5 py-4">
                        <div>
                            <h3 class="text-base font-semibold text-zinc-950">Tambah Data</h3>
                            <p class="mt-1 text-sm text-zinc-500">Pilih jenis data yang ingin ditambahkan.</p>
                        </div>
                        <button type="button" @click="actionModal = false" class="rounded-md p-1.5 text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-700">
                            <span class="sr-only">Tutup</span>
                            ✕
                        </button>
                    </div>

                    <div class="grid gap-2 p-3 sm:grid-cols-2">
                        <button type="button" @click="actionModal = false; $dispatch('open-modal', 'create-anggota-modal')" class="group rounded-xl border border-zinc-200 bg-white p-4 text-left transition hover:border-zinc-300 hover:bg-zinc-50">
                            <p class="text-sm font-semibold text-zinc-900">Tambah Anggota</p>
                            <p class="mt-1 text-xs leading-5 text-zinc-500">Daftarkan anggota baru ke sistem koperasi.</p>
                            <p class="mt-3 text-xs font-medium text-zinc-500 group-hover:text-zinc-900">Buka form →</p>
                        </button>

                        <button type="button" @click="actionModal = false; $dispatch('open-modal', 'create-simpanan-modal')" class="group rounded-xl border border-zinc-200 bg-white p-4 text-left transition hover:border-zinc-300 hover:bg-zinc-50">
                            <p class="text-sm font-semibold text-zinc-900">Input Simpanan</p>
                            <p class="mt-1 text-xs leading-5 text-zinc-500">Catat transaksi simpanan anggota.</p>
                            <p class="mt-3 text-xs font-medium text-zinc-500 group-hover:text-zinc-900">Buka form →</p>
                        </button>

                        <button type="button" @click="actionModal = false; $dispatch('open-modal', 'create-pinjaman-modal')" class="group rounded-xl border border-zinc-200 bg-white p-4 text-left transition hover:border-zinc-300 hover:bg-zinc-50">
                            <p class="text-sm font-semibold text-zinc-900">Input Pinjaman</p>
                            <p class="mt-1 text-xs leading-5 text-zinc-500">Tambah pengajuan atau pinjaman berjalan.</p>
                            <p class="mt-3 text-xs font-medium text-zinc-500 group-hover:text-zinc-900">Buka form →</p>
                        </button>

                        <button type="button" @click="actionModal = false; $dispatch('open-modal', 'create-angsuran-modal')" class="group rounded-xl border border-zinc-200 bg-white p-4 text-left transition hover:border-zinc-300 hover:bg-zinc-50">
                            <p class="text-sm font-semibold text-zinc-900">Input Angsuran</p>
                            <p class="mt-1 text-xs leading-5 text-zinc-500">Catat pembayaran angsuran pinjaman.</p>
                            <p class="mt-3 text-xs font-medium text-zinc-500 group-hover:text-zinc-900">Buka form →</p>
                        </button>
                    </div>

                    <div class="border-t border-zinc-100 px-5 py-3">
                        <button type="button" @click="actionModal = false" class="w-full rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-600 transition hover:bg-zinc-50 hover:text-zinc-900">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('components.create-modals', [
            'showAnggota' => true,
            'showSimpanan' => true,
            'showPinjaman' => true,
            'showAngsuran' => true,
            'anggotaOptions' => $anggotaOptions,
            'pinjamanOptions' => $pinjamanOptions,
        ])
    </div>
</x-app-layout>
