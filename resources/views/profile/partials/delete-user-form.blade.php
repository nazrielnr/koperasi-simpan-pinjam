<section class="space-y-5">
    <header>
        <h2 class="text-sm font-semibold text-zinc-900">Hapus Akun</h2>
        <p class="mt-1 text-sm leading-6 text-zinc-500">Aksi ini permanen dan akan menghapus akun dari sistem.</p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Hapus Akun
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-base font-semibold text-zinc-900">Hapus akun ini?</h2>
            <p class="mt-1 text-sm leading-6 text-zinc-500">Masukkan password untuk mengonfirmasi penghapusan akun.</p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="Password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                <x-danger-button>Hapus Akun</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
