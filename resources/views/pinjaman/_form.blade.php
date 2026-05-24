@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-700">Anggota</label>
        <select name="anggota_id" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">
            <option value="">-- pilih anggota --</option>
            @foreach ($anggotas as $item)
                <option value="{{ $item->id }}" @selected(old('anggota_id', $pinjaman->anggota_id) == $item->id)>{{ $item->nama }} ({{ $item->nomor_anggota }})</option>
            @endforeach
        </select>
        @error('anggota_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Nomor Pinjaman</label>
        <input name="nomor_pinjaman" value="{{ old('nomor_pinjaman', $pinjaman->nomor_pinjaman) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('nomor_pinjaman') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Jumlah Pokok</label>
        <input type="number" name="jumlah_pokok" value="{{ old('jumlah_pokok', $pinjaman->jumlah_pokok) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('jumlah_pokok') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Bunga (%)</label>
        <input type="number" step="0.01" name="bunga_persen" value="{{ old('bunga_persen', $pinjaman->bunga_persen) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('bunga_persen') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Tenor (bulan)</label>
        <input type="number" name="tenor_bulan" value="{{ old('tenor_bulan', $pinjaman->tenor_bulan) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('tenor_bulan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Tanggal Cair</label>
        <input type="date" name="tanggal_cair" value="{{ old('tanggal_cair', optional($pinjaman->tanggal_cair)->format('Y-m-d')) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('tanggal_cair') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Jatuh Tempo</label>
        <input type="date" name="jatuh_tempo" value="{{ old('jatuh_tempo', optional($pinjaman->jatuh_tempo)->format('Y-m-d')) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('jatuh_tempo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Status</label>
        <select name="status" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">
            <option value="pengajuan" @selected(old('status', $pinjaman->status) === 'pengajuan')>Pengajuan</option>
            <option value="berjalan" @selected(old('status', $pinjaman->status) === 'berjalan')>Berjalan</option>
            <option value="lunas" @selected(old('status', $pinjaman->status) === 'lunas')>Lunas</option>
            <option value="ditolak" @selected(old('status', $pinjaman->status) === 'ditolak')>Ditolak</option>
        </select>
        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-700">Keterangan</label>
        <textarea name="keterangan" rows="3" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">{{ old('keterangan', $pinjaman->keterangan) }}</textarea>
        @error('keterangan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-zinc-800 active:scale-[0.98]">Simpan</button>
    <a href="{{ route('pinjaman.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 shadow-sm transition hover:bg-zinc-50">Batal</a>
</div>
