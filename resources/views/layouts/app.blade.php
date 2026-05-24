<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Koperasi') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen bg-zinc-50 font-sans text-zinc-900 antialiased">

@php
$navItems = [
    [
        'label'  => 'Dashboard',
        'route'  => 'dashboard',
        'active' => 'dashboard',
        'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
    ],
    [
        'label'  => 'Anggota',
        'route'  => 'anggota.index',
        'active' => 'anggota.*',
        'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
    ],
    [
        'label'  => 'Simpanan',
        'route'  => 'simpanan.index',
        'active' => 'simpanan.*',
        'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>',
    ],
    [
        'label'  => 'Pinjaman',
        'route'  => 'pinjaman.index',
        'active' => 'pinjaman.*',
        'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    ],
    [
        'label'  => 'Angsuran',
        'route'  => 'angsuran.index',
        'active' => 'angsuran.*',
        'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>',
    ],
];

$bottomItems = [
    [
        'label'  => 'Profile',
        'route'  => 'profile.edit',
        'active' => 'profile.*',
        'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>',
    ],
];

$routeName   = request()->route()?->getName() ?? '';
$breadcrumbs = [];
if (str_starts_with($routeName, 'anggota'))      $breadcrumbs[] = ['label' => 'Anggota',  'url' => route('anggota.index')];
elseif (str_starts_with($routeName, 'simpanan')) $breadcrumbs[] = ['label' => 'Simpanan', 'url' => route('simpanan.index')];
elseif (str_starts_with($routeName, 'pinjaman')) $breadcrumbs[] = ['label' => 'Pinjaman', 'url' => route('pinjaman.index')];
elseif (str_starts_with($routeName, 'angsuran')) $breadcrumbs[] = ['label' => 'Angsuran', 'url' => route('angsuran.index')];
elseif (str_starts_with($routeName, 'profile'))  $breadcrumbs[] = ['label' => 'Profile',  'url' => route('profile.edit')];

if (str_ends_with($routeName, '.create'))        $breadcrumbs[] = ['label' => 'Tambah Baru', 'url' => null];
elseif (str_ends_with($routeName, '.edit'))      $breadcrumbs[] = ['label' => 'Edit',         'url' => null];
elseif (str_ends_with($routeName, '.show'))      $breadcrumbs[] = ['label' => 'Detail',        'url' => null];
@endphp

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    {{-- Mobile overlay --}}
    <div x-cloak x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-black/30 backdrop-blur-[2px] lg:hidden"
        @click="sidebarOpen = false">
    </div>

    {{-- ===== SIDEBAR ===== --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 flex w-60 flex-col bg-white border-r border-zinc-200/80 transition-transform duration-300 ease-in-out lg:translate-x-0">

        {{-- Brand --}}
        <div class="flex h-14 shrink-0 items-center gap-2.5 border-b border-zinc-100 px-4">
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-zinc-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="truncate text-sm font-semibold text-zinc-900 leading-tight">Koperasi SP</p>
                <p class="truncate text-[11px] text-zinc-400 leading-tight">Simpan Pinjam</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto px-2.5 py-3 space-y-4">
            <div>
                <p class="mb-1 px-2.5 text-[10px] font-semibold uppercase tracking-widest text-zinc-400">Menu</p>
                <ul class="space-y-0.5">
                    @foreach ($navItems as $item)
                        @php $isActive = request()->routeIs($item['active']); @endphp
                        <li>
                            <a href="{{ route($item['route']) }}"
                               class="group flex items-center gap-2.5 rounded-md px-2.5 py-2 text-sm font-medium transition-colors duration-100
                                      {{ $isActive ? 'bg-zinc-900 text-white' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900' }}">
                                <span class="shrink-0 {{ $isActive ? 'text-white' : 'text-zinc-400 group-hover:text-zinc-600' }} transition-colors">
                                    {!! $item['icon'] !!}
                                </span>
                                <span class="truncate">{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="mb-1 px-2.5 text-[10px] font-semibold uppercase tracking-widest text-zinc-400">Akun</p>
                <ul class="space-y-0.5">
                    @foreach ($bottomItems as $item)
                        @php $isActive = request()->routeIs($item['active']); @endphp
                        <li>
                            <a href="{{ route($item['route']) }}"
                               class="group flex items-center gap-2.5 rounded-md px-2.5 py-2 text-sm font-medium transition-colors duration-100
                                      {{ $isActive ? 'bg-zinc-900 text-white' : 'text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900' }}">
                                <span class="shrink-0 {{ $isActive ? 'text-white' : 'text-zinc-400 group-hover:text-zinc-600' }} transition-colors">
                                    {!! $item['icon'] !!}
                                </span>
                                <span class="truncate">{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        {{-- User footer --}}
        <div class="shrink-0 border-t border-zinc-100 p-2.5">
            <div class="flex items-center gap-2.5 rounded-md px-2 py-2">
                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-zinc-200 text-[11px] font-bold text-zinc-700 uppercase select-none">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-medium text-zinc-800">{{ auth()->user()->name }}</p>
                    <p class="truncate text-[11px] text-zinc-400">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Logout"
                            class="flex h-7 w-7 shrink-0 items-center justify-center rounded-md text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN AREA ===== --}}
    <div class="flex min-w-0 flex-1 flex-col lg:pl-60">

        {{-- Top header --}}
        <header class="sticky top-0 z-30 flex h-14 shrink-0 items-center gap-3 border-b border-zinc-200/80 bg-white/95 px-4 backdrop-blur-sm sm:px-6">

            <button @click="sidebarOpen = true"
                    class="flex h-8 w-8 items-center justify-center rounded-md text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-800 lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Breadcrumb --}}
            <nav class="flex min-w-0 flex-1 items-center gap-1.5 text-sm" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="shrink-0 text-zinc-400 transition hover:text-zinc-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </a>
                @foreach ($breadcrumbs as $crumb)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                    @if ($crumb['url'])
                        <a href="{{ $crumb['url'] }}" class="truncate text-zinc-400 transition hover:text-zinc-700">{{ $crumb['label'] }}</a>
                    @else
                        <span class="truncate font-medium text-zinc-700">{{ $crumb['label'] }}</span>
                    @endif
                @endforeach
                @if (empty($breadcrumbs))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="truncate font-medium text-zinc-700">Dashboard</span>
                @endif
            </nav>

            {{-- Right: date + avatar --}}
            <div class="flex shrink-0 items-center gap-2.5">
                <span class="hidden text-xs text-zinc-400 sm:block">
                    {{ now()->locale('id')->isoFormat('D MMM YYYY') }}
                </span>
                <div class="flex h-7 w-7 items-center justify-center rounded-full bg-zinc-200 text-[11px] font-bold text-zinc-700 uppercase select-none">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        {{-- Main content --}}
        <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8">
            @isset($header)
                <div class="mb-6">
                    {{ $header }}
                </div>
            @endisset

            @if (session('success'))
                <div class="mb-4 flex items-center gap-2.5 rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm text-zinc-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 flex items-center gap-2.5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>
</div>

</body>
</html>
