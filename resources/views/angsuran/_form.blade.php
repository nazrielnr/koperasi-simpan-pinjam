@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-700">Pinjaman</label>
        <select name="pinjaman_id" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">
            <option value="">-- pilih pinjaman --</option>
            @foreach ($pinjamans as $item)
                <option value="{{ $item->id }}" @selected(old('pinjaman_id', $angsuran->pinjaman_id) == $item->id)>{{ $item->nomor_pinjaman }} - {{ $item->anggota?->nama }}</option>
            @endforeach
        </select>
        @error('pinjaman_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Nomor Angsuran</label>
        <input type="number" name="nomor_angsuran" value="{{ old('nomor_angsuran', $angsuran->nomor_angsuran) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('nomor_angsuran') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Jumlah Bayar</label>
        <input type="number" name="jumlah_bayar" value="{{ old('jumlah_bayar', $angsuran->jumlah_bayar) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('jumlah_bayar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Pokok</label>
        <input type="number" name="pokok" value="{{ old('pokok', $angsuran->pokok) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('pokok') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Bunga</label>
        <input type="number" name="bunga" value="{{ old('bunga', $angsuran->bunga) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('bunga') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Denda</label>
        <input type="number" name="denda" value="{{ old('denda', $angsuran->denda) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('denda') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Tanggal Jatuh Tempo</label>
        <input type="date" name="tanggal_jatuh_tempo" value="{{ old('tanggal_jatuh_tempo', optional($angsuran->tanggal_jatuh_tempo)->format('Y-m-d')) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('tanggal_jatuh_tempo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Tanggal Bayar</label>
        <input type="date" name="tanggal_bayar" value="{{ old('tanggal_bayar', optional($angsuran->tanggal_bayar)->format('Y-m-d')) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('tanggal_bayar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Status</label>
        <select name="status" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">
            <option value="jatuh_tempo" @selected(old('status', $angsuran->status) === 'jatuh_tempo')>Jatuh Tempo</option>
            <option value="dibayar" @selected(old('status', $angsuran->status) === 'dibayar')>Dibayar</option>
            <option value="tertunda" @selected(old('status', $angsuran->status) === 'tertunda')>Tertunda</option>
        </select>
        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-700">Keterangan</label>
        <textarea name="keterangan" rows="3" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">{{ old('keterangan', $angsuran->keterangan) }}</textarea>
        @error('keterangan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-zinc-800 active:scale-[0.98]">Simpan</button>
    <a href="{{ route('angsuran.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 shadow-sm transition hover:bg-zinc-50">Batal</a>
</div>
