@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-700">Anggota</label>
        <select name="anggota_id" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">
            <option value="">-- pilih anggota --</option>
            @foreach ($anggotas as $item)
                <option value="{{ $item->id }}" @selected(old('anggota_id', $simpanan->anggota_id) == $item->id)>{{ $item->nama }} ({{ $item->nomor_anggota }})</option>
            @endforeach
        </select>
        @error('anggota_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Jenis</label>
        <select name="jenis" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">
            <option value="pokok" @selected(old('jenis', $simpanan->jenis) === 'pokok')>Pokok</option>
            <option value="wajib" @selected(old('jenis', $simpanan->jenis) === 'wajib')>Wajib</option>
            <option value="sukarela" @selected(old('jenis', $simpanan->jenis) === 'sukarela')>Sukarela</option>
        </select>
        @error('jenis') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Jumlah</label>
        <input type="number" name="jumlah" value="{{ old('jumlah', $simpanan->jumlah) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('jumlah') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Tanggal Transaksi</label>
        <input type="date" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', optional($simpanan->tanggal_transaksi)->format('Y-m-d')) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('tanggal_transaksi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Keterangan</label>
        <input name="keterangan" value="{{ old('keterangan', $simpanan->keterangan) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('keterangan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-zinc-800 active:scale-[0.98]">Simpan</button>
    <a href="{{ route('simpanan.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 shadow-sm transition hover:bg-zinc-50">Batal</a>
</div>
