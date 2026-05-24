<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-[linear-gradient(to_bottom,_#f8fafc,_#eef2ff)] px-4 py-8 sm:px-6 lg:px-8">
            <div class="w-full max-w-md">
                <div class="mb-6 flex items-center gap-3">
                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-slate-900 text-sm font-semibold text-white shadow-sm">SP</div>
                    <div>
                        <div class="text-lg font-semibold text-slate-900">{{ config('app.name', 'Simpan Pinjam') }}</div>
                        <div class="text-sm text-slate-500">Akses akun</div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h1 class="text-lg font-semibold text-slate-900">Masuk ke sistem</h1>
                        <p class="mt-1 text-sm text-slate-500">Kelola data koperasi dalam dashboard yang lebih bersih.</p>
                    </div>

                    <div class="p-6 sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
