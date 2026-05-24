@php
    $fieldClass = 'mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-zinc-500';
    $labelClass = 'block text-sm font-medium text-zinc-700';
    $errorClass = 'mt-1 text-sm text-red-600';
@endphp

@if (!empty($showAnggota))
    <x-modal name="create-anggota-modal" :show="old('_modal') === 'anggota'" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('anggota.store') }}" class="max-h-[85vh] overflow-y-auto p-6">
            @csrf
            <input type="hidden" name="_modal" value="anggota">
            <div class="mb-6">
                <h2 class="text-base font-semibold text-zinc-950">Tambah Anggota</h2>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Input identitas anggota baru tanpa meninggalkan halaman ini.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="{{ $labelClass }}">Nomor Anggota</label>
                    <input name="nomor_anggota" value="{{ old('nomor_anggota') }}" class="{{ $fieldClass }}" />
                    @error('nomor_anggota') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Nama</label>
                    <input name="nama" value="{{ old('nama') }}" class="{{ $fieldClass }}" />
                    @error('nama') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">NIK</label>
                    <input name="nik" value="{{ old('nik') }}" class="{{ $fieldClass }}" />
                    @error('nik') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Telepon</label>
                    <input name="telepon" value="{{ old('telepon') }}" class="{{ $fieldClass }}" />
                    @error('telepon') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Alamat</label>
                    <textarea name="alamat" rows="3" class="{{ $fieldClass }}">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Tanggal Gabung</label>
                    <input type="date" name="tanggal_gabung" value="{{ old('tanggal_gabung', now()->toDateString()) }}" class="{{ $fieldClass }}" />
                    @error('tanggal_gabung') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Status</label>
                    <select name="status" class="{{ $fieldClass }}">
                        <option value="aktif" @selected(old('status', 'aktif') === 'aktif')>Aktif</option>
                        <option value="nonaktif" @selected(old('status') === 'nonaktif')>Nonaktif</option>
                    </select>
                    @error('status') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan</button>
            </div>
        </form>
    </x-modal>
@endif

@if (!empty($showSimpanan))
    <x-modal name="create-simpanan-modal" :show="old('_modal') === 'simpanan'" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('simpanan.store') }}" class="max-h-[85vh] overflow-y-auto p-6">
            @csrf
            <input type="hidden" name="_modal" value="simpanan">
            <div class="mb-6">
                <h2 class="text-base font-semibold text-zinc-950">Tambah Simpanan</h2>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Catat transaksi simpanan anggota.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Anggota</label>
                    <select name="anggota_id" class="{{ $fieldClass }}">
                        <option value="">Pilih anggota</option>
                        @foreach (($anggotaOptions ?? collect()) as $item)
                            <option value="{{ $item->id }}" @selected(old('anggota_id') == $item->id)>{{ $item->nama }} ({{ $item->nomor_anggota }})</option>
                        @endforeach
                    </select>
                    @error('anggota_id') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Jenis</label>
                    <select name="jenis" class="{{ $fieldClass }}">
                        <option value="pokok" @selected(old('jenis') === 'pokok')>Pokok</option>
                        <option value="wajib" @selected(old('jenis', 'wajib') === 'wajib')>Wajib</option>
                        <option value="sukarela" @selected(old('jenis') === 'sukarela')>Sukarela</option>
                    </select>
                    @error('jenis') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Jumlah</label>
                    <input type="number" name="jumlah" value="{{ old('jumlah') }}" class="{{ $fieldClass }}" />
                    @error('jumlah') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Tanggal Transaksi</label>
                    <input type="date" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', now()->toDateString()) }}" class="{{ $fieldClass }}" />
                    @error('tanggal_transaksi') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Keterangan</label>
                    <input name="keterangan" value="{{ old('keterangan') }}" class="{{ $fieldClass }}" />
                    @error('keterangan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan</button>
            </div>
        </form>
    </x-modal>
@endif

@if (!empty($showPinjaman))
    <x-modal name="create-pinjaman-modal" :show="old('_modal') === 'pinjaman'" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('pinjaman.store') }}" class="max-h-[85vh] overflow-y-auto p-6">
            @csrf
            <input type="hidden" name="_modal" value="pinjaman">
            <div class="mb-6">
                <h2 class="text-base font-semibold text-zinc-950">Tambah Pinjaman</h2>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Input pengajuan dan detail pinjaman anggota.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Anggota</label>
                    <select name="anggota_id" class="{{ $fieldClass }}">
                        <option value="">Pilih anggota</option>
                        @foreach (($anggotaOptions ?? collect()) as $item)
                            <option value="{{ $item->id }}" @selected(old('anggota_id') == $item->id)>{{ $item->nama }} ({{ $item->nomor_anggota }})</option>
                        @endforeach
                    </select>
                    @error('anggota_id') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Nomor Pinjaman</label>
                    <input name="nomor_pinjaman" value="{{ old('nomor_pinjaman') }}" class="{{ $fieldClass }}" />
                    @error('nomor_pinjaman') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Jumlah Pokok</label>
                    <input type="number" name="jumlah_pokok" value="{{ old('jumlah_pokok') }}" class="{{ $fieldClass }}" />
                    @error('jumlah_pokok') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Bunga (%)</label>
                    <input type="number" step="0.01" name="bunga_persen" value="{{ old('bunga_persen', 1.5) }}" class="{{ $fieldClass }}" />
                    @error('bunga_persen') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Tenor (bulan)</label>
                    <input type="number" name="tenor_bulan" value="{{ old('tenor_bulan', 12) }}" class="{{ $fieldClass }}" />
                    @error('tenor_bulan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Tanggal Cair</label>
                    <input type="date" name="tanggal_cair" value="{{ old('tanggal_cair', now()->toDateString()) }}" class="{{ $fieldClass }}" />
                    @error('tanggal_cair') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Jatuh Tempo</label>
                    <input type="date" name="jatuh_tempo" value="{{ old('jatuh_tempo', now()->addMonths(12)->toDateString()) }}" class="{{ $fieldClass }}" />
                    @error('jatuh_tempo') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Status</label>
                    <select name="status" class="{{ $fieldClass }}">
                        <option value="pengajuan" @selected(old('status', 'pengajuan') === 'pengajuan')>Pengajuan</option>
                        <option value="berjalan" @selected(old('status') === 'berjalan')>Berjalan</option>
                        <option value="lunas" @selected(old('status') === 'lunas')>Lunas</option>
                        <option value="ditolak" @selected(old('status') === 'ditolak')>Ditolak</option>
                    </select>
                    @error('status') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="{{ $fieldClass }}">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan</button>
            </div>
        </form>
    </x-modal>
@endif

@if (!empty($showAngsuran))
    <x-modal name="create-angsuran-modal" :show="old('_modal') === 'angsuran'" maxWidth="2xl" focusable>
        <form method="POST" action="{{ route('angsuran.store') }}" class="max-h-[85vh] overflow-y-auto p-6">
            @csrf
            <input type="hidden" name="_modal" value="angsuran">
            <div class="mb-6">
                <h2 class="text-base font-semibold text-zinc-950">Tambah Angsuran</h2>
                <p class="mt-1 text-sm leading-6 text-zinc-500">Catat pembayaran angsuran pinjaman.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Pinjaman</label>
                    <select name="pinjaman_id" class="{{ $fieldClass }}">
                        <option value="">Pilih pinjaman</option>
                        @foreach (($pinjamanOptions ?? collect()) as $item)
                            <option value="{{ $item->id }}" @selected(old('pinjaman_id') == $item->id)>{{ $item->nomor_pinjaman }} - {{ $item->anggota?->nama }}</option>
                        @endforeach
                    </select>
                    @error('pinjaman_id') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Nomor Angsuran</label>
                    <input type="number" name="nomor_angsuran" value="{{ old('nomor_angsuran', 1) }}" class="{{ $fieldClass }}" />
                    @error('nomor_angsuran') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" value="{{ old('jumlah_bayar') }}" class="{{ $fieldClass }}" />
                    @error('jumlah_bayar') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Pokok</label>
                    <input type="number" name="pokok" value="{{ old('pokok') }}" class="{{ $fieldClass }}" />
                    @error('pokok') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Bunga</label>
                    <input type="number" name="bunga" value="{{ old('bunga') }}" class="{{ $fieldClass }}" />
                    @error('bunga') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Denda</label>
                    <input type="number" name="denda" value="{{ old('denda', 0) }}" class="{{ $fieldClass }}" />
                    @error('denda') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggal_jatuh_tempo" value="{{ old('tanggal_jatuh_tempo', now()->toDateString()) }}" class="{{ $fieldClass }}" />
                    @error('tanggal_jatuh_tempo') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Tanggal Bayar</label>
                    <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar') }}" class="{{ $fieldClass }}" />
                    @error('tanggal_bayar') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="{{ $labelClass }}">Status</label>
                    <select name="status" class="{{ $fieldClass }}">
                        <option value="jatuh_tempo" @selected(old('status', 'jatuh_tempo') === 'jatuh_tempo')>Jatuh Tempo</option>
                        <option value="dibayar" @selected(old('status') === 'dibayar')>Dibayar</option>
                        <option value="tertunda" @selected(old('status') === 'tertunda')>Tertunda</option>
                    </select>
                    @error('status') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
                <div class="md:col-span-2">
                    <label class="{{ $labelClass }}">Keterangan</label>
                    <textarea name="keterangan" rows="3" class="{{ $fieldClass }}">{{ old('keterangan') }}</textarea>
                    @error('keterangan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan</button>
            </div>
        </form>
    </x-modal>
@endif
