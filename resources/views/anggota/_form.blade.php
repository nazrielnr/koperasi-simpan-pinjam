@csrf

<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Nomor Anggota</label>
        <input name="nomor_anggota" value="{{ old('nomor_anggota', $anggota->nomor_anggota) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('nomor_anggota') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Nama</label>
        <input name="nama" value="{{ old('nama', $anggota->nama) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('nama') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">NIK</label>
        <input name="nik" value="{{ old('nik', $anggota->nik) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('nik') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Telepon</label>
        <input name="telepon" value="{{ old('telepon', $anggota->telepon) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('telepon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div class="md:col-span-2">
        <label class="mb-2 block text-sm font-medium text-zinc-700">Alamat</label>
        <textarea name="alamat" rows="3" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">{{ old('alamat', $anggota->alamat) }}</textarea>
        @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Tanggal Gabung</label>
        <input type="date" name="tanggal_gabung" value="{{ old('tanggal_gabung', optional($anggota->tanggal_gabung)->format('Y-m-d')) }}" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500" />
        @error('tanggal_gabung') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-700">Status</label>
        <select name="status" class="w-full rounded-lg border-zinc-300 bg-white text-zinc-900 shadow-sm transition focus:border-zinc-500 focus:ring-zinc-500">
            <option value="aktif" @selected(old('status', $anggota->status) === 'aktif')>Aktif</option>
            <option value="nonaktif" @selected(old('status', $anggota->status) === 'nonaktif')>Nonaktif</option>
        </select>
        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-6 flex flex-wrap gap-3">
    <button class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-zinc-800 active:scale-[0.98]">Simpan</button>
    <a href="{{ route('anggota.index') }}" class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 shadow-sm transition hover:bg-zinc-50">Batal</a>
</div>
