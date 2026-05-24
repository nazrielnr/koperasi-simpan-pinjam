@php
    $fieldClass = 'mt-2 block w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition placeholder:text-zinc-400 focus:border-zinc-500 focus:ring-zinc-500';
    $labelClass = 'block text-sm font-medium text-zinc-700';
    $errorClass = 'mt-1 text-sm text-red-600';
@endphp

@if (!empty($editAnggotas))
    @foreach ($editAnggotas as $anggota)
        @php
            $modalName = 'edit-anggota-' . $anggota->id;
            $isCurrentModal = old('_modal') === $modalName;
            $form = [
                'nomor_anggota' => $isCurrentModal ? old('nomor_anggota', $anggota->nomor_anggota) : $anggota->nomor_anggota,
                'nama' => $isCurrentModal ? old('nama', $anggota->nama) : $anggota->nama,
                'nik' => $isCurrentModal ? old('nik', $anggota->nik) : $anggota->nik,
                'telepon' => $isCurrentModal ? old('telepon', $anggota->telepon) : $anggota->telepon,
                'alamat' => $isCurrentModal ? old('alamat', $anggota->alamat) : $anggota->alamat,
                'tanggal_gabung' => $isCurrentModal ? old('tanggal_gabung', optional($anggota->tanggal_gabung)->format('Y-m-d')) : optional($anggota->tanggal_gabung)->format('Y-m-d'),
                'status' => $isCurrentModal ? old('status', $anggota->status) : $anggota->status,
            ];
        @endphp

        <x-modal name="{{ $modalName }}" :show="$isCurrentModal" maxWidth="2xl" focusable>
            <form method="POST" action="{{ route('anggota.update', $anggota) }}" class="max-h-[85vh] overflow-y-auto p-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="_modal" value="{{ $modalName }}">
                    <div class="mb-6">
                        <h2 class="text-base font-semibold text-zinc-950">Edit Anggota</h2>
                        <p class="mt-1 text-sm leading-6 text-zinc-500">Perbarui identitas, kontak, dan status anggota tanpa meninggalkan halaman ini.</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label class="{{ $labelClass }}">Nomor Anggota</label>
                            <input name="nomor_anggota" value="{{ $form['nomor_anggota'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('nomor_anggota') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Nama</label>
                            <input name="nama" value="{{ $form['nama'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('nama') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">NIK</label>
                            <input name="nik" value="{{ $form['nik'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('nik') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Telepon</label>
                            <input name="telepon" value="{{ $form['telepon'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('telepon') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div class="md:col-span-2">
                            <label class="{{ $labelClass }}">Alamat</label>
                            <textarea name="alamat" rows="3" class="{{ $fieldClass }}">{{ $form['alamat'] }}</textarea>
                            @if ($isCurrentModal) @error('alamat') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Tanggal Gabung</label>
                            <input type="date" name="tanggal_gabung" value="{{ $form['tanggal_gabung'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('tanggal_gabung') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Status</label>
                            <select name="status" class="{{ $fieldClass }}">
                                <option value="aktif" @selected($form['status'] === 'aktif')>Aktif</option>
                                <option value="nonaktif" @selected($form['status'] === 'nonaktif')>Nonaktif</option>
                            </select>
                            @if ($isCurrentModal) @error('status') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                        <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                        <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan Perubahan</button>
                    </div>
            </form>
        </x-modal>
    @endforeach
@endif

@if (!empty($editSimpanans))
    @foreach ($editSimpanans as $simpanan)
        @php
            $modalName = 'edit-simpanan-' . $simpanan->id;
            $isCurrentModal = old('_modal') === $modalName;
            $form = [
                'anggota_id' => $isCurrentModal ? old('anggota_id', $simpanan->anggota_id) : $simpanan->anggota_id,
                'jenis' => $isCurrentModal ? old('jenis', $simpanan->jenis) : $simpanan->jenis,
                'jumlah' => $isCurrentModal ? old('jumlah', $simpanan->jumlah) : $simpanan->jumlah,
                'tanggal_transaksi' => $isCurrentModal ? old('tanggal_transaksi', optional($simpanan->tanggal_transaksi)->format('Y-m-d')) : optional($simpanan->tanggal_transaksi)->format('Y-m-d'),
                'keterangan' => $isCurrentModal ? old('keterangan', $simpanan->keterangan) : $simpanan->keterangan,
            ];
        @endphp

        <x-modal name="{{ $modalName }}" :show="$isCurrentModal" maxWidth="2xl" focusable>
            <form method="POST" action="{{ route('simpanan.update', $simpanan) }}" class="max-h-[85vh] overflow-y-auto p-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="_modal" value="{{ $modalName }}">
                    <div class="mb-6">
                        <h2 class="text-base font-semibold text-zinc-950">Edit Simpanan</h2>
                        <p class="mt-1 text-sm leading-6 text-zinc-500">Perbarui nominal, jenis, tanggal, atau keterangan simpanan.</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="{{ $labelClass }}">Anggota</label>
                            <select name="anggota_id" class="{{ $fieldClass }}">
                                <option value="">Pilih anggota</option>
                                @foreach (($anggotaOptions ?? collect()) as $option)
                                    <option value="{{ $option->id }}" @selected($form['anggota_id'] == $option->id)>{{ $option->nama }} ({{ $option->nomor_anggota }})</option>
                                @endforeach
                            </select>
                            @if ($isCurrentModal) @error('anggota_id') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Jenis</label>
                            <select name="jenis" class="{{ $fieldClass }}">
                                <option value="pokok" @selected($form['jenis'] === 'pokok')>Pokok</option>
                                <option value="wajib" @selected($form['jenis'] === 'wajib')>Wajib</option>
                                <option value="sukarela" @selected($form['jenis'] === 'sukarela')>Sukarela</option>
                            </select>
                            @if ($isCurrentModal) @error('jenis') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Jumlah</label>
                            <input type="number" name="jumlah" value="{{ $form['jumlah'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('jumlah') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Tanggal Transaksi</label>
                            <input type="date" name="tanggal_transaksi" value="{{ $form['tanggal_transaksi'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('tanggal_transaksi') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Keterangan</label>
                            <input name="keterangan" value="{{ $form['keterangan'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('keterangan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                        <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                        <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan Perubahan</button>
                    </div>
            </form>
        </x-modal>
    @endforeach
@endif

@if (!empty($editPinjamans))
    @foreach ($editPinjamans as $pinjaman)
        @php
            $modalName = 'edit-pinjaman-' . $pinjaman->id;
            $isCurrentModal = old('_modal') === $modalName;
            $form = [
                'anggota_id' => $isCurrentModal ? old('anggota_id', $pinjaman->anggota_id) : $pinjaman->anggota_id,
                'nomor_pinjaman' => $isCurrentModal ? old('nomor_pinjaman', $pinjaman->nomor_pinjaman) : $pinjaman->nomor_pinjaman,
                'jumlah_pokok' => $isCurrentModal ? old('jumlah_pokok', $pinjaman->jumlah_pokok) : $pinjaman->jumlah_pokok,
                'bunga_persen' => $isCurrentModal ? old('bunga_persen', $pinjaman->bunga_persen) : $pinjaman->bunga_persen,
                'tenor_bulan' => $isCurrentModal ? old('tenor_bulan', $pinjaman->tenor_bulan) : $pinjaman->tenor_bulan,
                'tanggal_cair' => $isCurrentModal ? old('tanggal_cair', optional($pinjaman->tanggal_cair)->format('Y-m-d')) : optional($pinjaman->tanggal_cair)->format('Y-m-d'),
                'jatuh_tempo' => $isCurrentModal ? old('jatuh_tempo', optional($pinjaman->jatuh_tempo)->format('Y-m-d')) : optional($pinjaman->jatuh_tempo)->format('Y-m-d'),
                'status' => $isCurrentModal ? old('status', $pinjaman->status) : $pinjaman->status,
                'keterangan' => $isCurrentModal ? old('keterangan', $pinjaman->keterangan) : $pinjaman->keterangan,
            ];
        @endphp

        <x-modal name="{{ $modalName }}" :show="$isCurrentModal" maxWidth="2xl" focusable>
            <form method="POST" action="{{ route('pinjaman.update', $pinjaman) }}" class="max-h-[85vh] overflow-y-auto p-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="_modal" value="{{ $modalName }}">
                    <div class="mb-6">
                        <h2 class="text-base font-semibold text-zinc-950">Edit Pinjaman</h2>
                        <p class="mt-1 text-sm leading-6 text-zinc-500">Perbarui data pinjaman dan status pencairan yang sudah tersimpan.</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="{{ $labelClass }}">Anggota</label>
                            <select name="anggota_id" class="{{ $fieldClass }}">
                                <option value="">Pilih anggota</option>
                                @foreach (($anggotaOptions ?? collect()) as $option)
                                    <option value="{{ $option->id }}" @selected($form['anggota_id'] == $option->id)>{{ $option->nama }} ({{ $option->nomor_anggota }})</option>
                                @endforeach
                            </select>
                            @if ($isCurrentModal) @error('anggota_id') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Nomor Pinjaman</label>
                            <input name="nomor_pinjaman" value="{{ $form['nomor_pinjaman'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('nomor_pinjaman') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Jumlah Pokok</label>
                            <input type="number" name="jumlah_pokok" value="{{ $form['jumlah_pokok'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('jumlah_pokok') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Bunga (%)</label>
                            <input type="number" step="0.01" name="bunga_persen" value="{{ $form['bunga_persen'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('bunga_persen') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Tenor (bulan)</label>
                            <input type="number" name="tenor_bulan" value="{{ $form['tenor_bulan'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('tenor_bulan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Tanggal Cair</label>
                            <input type="date" name="tanggal_cair" value="{{ $form['tanggal_cair'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('tanggal_cair') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Jatuh Tempo</label>
                            <input type="date" name="jatuh_tempo" value="{{ $form['jatuh_tempo'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('jatuh_tempo') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Status</label>
                            <select name="status" class="{{ $fieldClass }}">
                                <option value="pengajuan" @selected($form['status'] === 'pengajuan')>Pengajuan</option>
                                <option value="berjalan" @selected($form['status'] === 'berjalan')>Berjalan</option>
                                <option value="lunas" @selected($form['status'] === 'lunas')>Lunas</option>
                                <option value="ditolak" @selected($form['status'] === 'ditolak')>Ditolak</option>
                            </select>
                            @if ($isCurrentModal) @error('status') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div class="md:col-span-2">
                            <label class="{{ $labelClass }}">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="{{ $fieldClass }}">{{ $form['keterangan'] }}</textarea>
                            @if ($isCurrentModal) @error('keterangan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                        <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                        <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan Perubahan</button>
                    </div>
            </form>
        </x-modal>
    @endforeach
@endif

@if (!empty($editAngsurans))
    @foreach ($editAngsurans as $angsuran)
        @php
            $modalName = 'edit-angsuran-' . $angsuran->id;
            $isCurrentModal = old('_modal') === $modalName;
            $form = [
                'pinjaman_id' => $isCurrentModal ? old('pinjaman_id', $angsuran->pinjaman_id) : $angsuran->pinjaman_id,
                'nomor_angsuran' => $isCurrentModal ? old('nomor_angsuran', $angsuran->nomor_angsuran) : $angsuran->nomor_angsuran,
                'jumlah_bayar' => $isCurrentModal ? old('jumlah_bayar', $angsuran->jumlah_bayar) : $angsuran->jumlah_bayar,
                'pokok' => $isCurrentModal ? old('pokok', $angsuran->pokok) : $angsuran->pokok,
                'bunga' => $isCurrentModal ? old('bunga', $angsuran->bunga) : $angsuran->bunga,
                'denda' => $isCurrentModal ? old('denda', $angsuran->denda) : $angsuran->denda,
                'tanggal_jatuh_tempo' => $isCurrentModal ? old('tanggal_jatuh_tempo', optional($angsuran->tanggal_jatuh_tempo)->format('Y-m-d')) : optional($angsuran->tanggal_jatuh_tempo)->format('Y-m-d'),
                'tanggal_bayar' => $isCurrentModal ? old('tanggal_bayar', optional($angsuran->tanggal_bayar)->format('Y-m-d')) : optional($angsuran->tanggal_bayar)->format('Y-m-d'),
                'status' => $isCurrentModal ? old('status', $angsuran->status) : $angsuran->status,
                'keterangan' => $isCurrentModal ? old('keterangan', $angsuran->keterangan) : $angsuran->keterangan,
            ];
        @endphp

        <x-modal name="{{ $modalName }}" :show="$isCurrentModal" maxWidth="2xl" focusable>
            <form method="POST" action="{{ route('angsuran.update', $angsuran) }}" class="max-h-[85vh] overflow-y-auto p-6">
                @csrf
                @method('PUT')
                <input type="hidden" name="_modal" value="{{ $modalName }}">
                    <div class="mb-6">
                        <h2 class="text-base font-semibold text-zinc-950">Edit Angsuran</h2>
                        <p class="mt-1 text-sm leading-6 text-zinc-500">Perbarui pembayaran angsuran dan status pelunasannya.</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="{{ $labelClass }}">Pinjaman</label>
                            <select name="pinjaman_id" class="{{ $fieldClass }}">
                                <option value="">Pilih pinjaman</option>
                                @foreach (($pinjamanOptions ?? collect()) as $option)
                                    <option value="{{ $option->id }}" @selected($form['pinjaman_id'] == $option->id)>{{ $option->nomor_pinjaman }} - {{ $option->anggota?->nama }}</option>
                                @endforeach
                            </select>
                            @if ($isCurrentModal) @error('pinjaman_id') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Nomor Angsuran</label>
                            <input type="number" name="nomor_angsuran" value="{{ $form['nomor_angsuran'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('nomor_angsuran') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Jumlah Bayar</label>
                            <input type="number" name="jumlah_bayar" value="{{ $form['jumlah_bayar'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('jumlah_bayar') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Pokok</label>
                            <input type="number" name="pokok" value="{{ $form['pokok'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('pokok') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Bunga</label>
                            <input type="number" name="bunga" value="{{ $form['bunga'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('bunga') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Denda</label>
                            <input type="number" name="denda" value="{{ $form['denda'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('denda') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Tanggal Jatuh Tempo</label>
                            <input type="date" name="tanggal_jatuh_tempo" value="{{ $form['tanggal_jatuh_tempo'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('tanggal_jatuh_tempo') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Tanggal Bayar</label>
                            <input type="date" name="tanggal_bayar" value="{{ $form['tanggal_bayar'] }}" class="{{ $fieldClass }}" />
                            @if ($isCurrentModal) @error('tanggal_bayar') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div>
                            <label class="{{ $labelClass }}">Status</label>
                            <select name="status" class="{{ $fieldClass }}">
                                <option value="jatuh_tempo" @selected($form['status'] === 'jatuh_tempo')>Jatuh Tempo</option>
                                <option value="dibayar" @selected($form['status'] === 'dibayar')>Dibayar</option>
                                <option value="tertunda" @selected($form['status'] === 'tertunda')>Tertunda</option>
                            </select>
                            @if ($isCurrentModal) @error('status') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                        <div class="md:col-span-2">
                            <label class="{{ $labelClass }}">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="{{ $fieldClass }}">{{ $form['keterangan'] }}</textarea>
                            @if ($isCurrentModal) @error('keterangan') <p class="{{ $errorClass }}">{{ $message }}</p> @enderror @endif
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-zinc-100 pt-4">
                        <button type="button" x-on:click="$dispatch('close')" class="rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50">Batal</button>
                        <button class="rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-zinc-800">Simpan Perubahan</button>
                    </div>
            </form>
        </x-modal>
    @endforeach
@endif
