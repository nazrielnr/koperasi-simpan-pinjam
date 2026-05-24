<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-950">Profile</h1>
            <p class="mt-1 text-sm leading-6 text-zinc-500">Perbarui informasi akun, password, dan pengaturan keamanan login.</p>
        </div>
    </x-slot>

    <div class="grid gap-6 xl:grid-cols-[minmax(0,1fr)_360px]">
        <div class="space-y-6">
            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-sm sm:p-6">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-zinc-200 text-sm font-semibold uppercase text-zinc-700">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-zinc-900">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs text-zinc-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="mt-5 border-t border-zinc-100 pt-4 text-sm leading-6 text-zinc-500">
                    Gunakan password yang unik dan jangan bagikan akses akun ke orang lain.
                </div>
            </div>

            <div class="rounded-2xl border border-red-100 bg-white p-5 shadow-sm sm:p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
