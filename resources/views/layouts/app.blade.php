<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    <script>
        window.tailwind = window.tailwind || {};
        tailwind.config = {
            theme: {
                extend: {
                    boxShadow: {
                        soft: '0 10px 30px -18px rgb(2 6 23 / 0.25)',
                    },
                },
            },
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@php($isAdminArea = request()->is('admin*'))
<body class="{{ $isAdminArea ? 'h-screen overflow-hidden bg-slate-50 text-slate-800 antialiased' : 'min-h-screen bg-gradient-to-b from-emerald-50/60 via-white to-slate-50 text-slate-800 antialiased pb-20' }}">
@unless($isAdminArea)
    <div class="sticky top-0 z-50 border-b border-emerald-100/70 bg-white/80 backdrop-blur-md shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="grid h-10 w-10 place-items-center overflow-hidden rounded-2xl bg-white ring-1 ring-emerald-100 shadow-soft">
                    <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-full w-full object-contain p-1.5">
                </span>
                <div class="leading-tight">
                    <div class="text-sm font-semibold text-slate-900">{{ config('app.name') }}</div>
                    <div class="text-xs text-slate-500">Repository Digital Kampus</div>
                </div>
            </a>

            <nav class="hidden items-center gap-1 rounded-2xl bg-slate-50/80 p-1 ring-1 ring-slate-200/60 shadow-soft md:flex">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Home</a>
                <a href="{{ route('koleksi.jurnal') }}" class="{{ request()->routeIs('koleksi.jurnal') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Jurnal</a>
                <a href="{{ route('koleksi.ejurnal') }}" class="{{ request()->routeIs('koleksi.ejurnal') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">E-Jurnal</a>
                <a href="{{ route('koleksi.buku') }}" class="{{ request()->routeIs('koleksi.buku') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Buku</a>
                <a href="{{ route('koleksi.ebook') }}" class="{{ request()->routeIs('koleksi.ebook') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">E-Book</a>
                <a href="{{ route('koleksi.skripsi') }}" class="{{ request()->routeIs('koleksi.skripsi') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Skripsi</a>
                <a href="{{ route('koleksi.pplkk') }}" class="{{ request()->routeIs('koleksi.pplkk') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">PPL KK</a>
                <a href="{{ route('mahasiswa.turnitin.index') }}" class="{{ request()->routeIs('mahasiswa.turnitin.*') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-600 hover:bg-white/80 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Turnitin</a>
            </nav>

            <div class="flex items-center gap-2">
                @auth
                    @if(auth()->user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.dashboard') }}" class="hidden items-center gap-2 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50 md:inline-flex">
                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Akun
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                            @csrf
                            <button type="submit" class="rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700 shadow-soft transition hover:bg-rose-100">Logout</button>
                        </form>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="hidden items-center gap-2 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50 md:inline-flex">
                        <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Login
                    </a>
                @endguest
                <button type="button" data-mobile-toggle="mobileNav" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2 text-slate-700 shadow-soft transition hover:bg-slate-50 md:hidden">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobileNav" class="hidden border-t border-emerald-100/70 bg-white md:hidden">
            <div class="mx-auto px-4 py-3 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-2 rounded-2xl bg-slate-50/80 p-2 ring-1 ring-slate-200/60 shadow-soft">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Home</a>
                    <a href="{{ route('koleksi.jurnal') }}" class="{{ request()->routeIs('koleksi.jurnal') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Jurnal</a>
                    <a href="{{ route('koleksi.ejurnal') }}" class="{{ request()->routeIs('koleksi.ejurnal') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">E-Jurnal</a>
                    <a href="{{ route('koleksi.buku') }}" class="{{ request()->routeIs('koleksi.buku') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Buku</a>
                    <a href="{{ route('koleksi.ebook') }}" class="{{ request()->routeIs('koleksi.ebook') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">E-Book</a>
                    <a href="{{ route('koleksi.skripsi') }}" class="{{ request()->routeIs('koleksi.skripsi') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Skripsi</a>
                    <a href="{{ route('koleksi.pplkk') }}" class="{{ request()->routeIs('koleksi.pplkk') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">PPL KK</a>
                    <a href="{{ route('mahasiswa.turnitin.index') }}" class="{{ request()->routeIs('mahasiswa.turnitin.*') ? 'bg-white text-emerald-700 shadow-soft ring-1 ring-emerald-200/60' : 'text-slate-700 hover:bg-white/80' }} rounded-xl px-3 py-2 text-sm font-semibold transition">Turnitin</a>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="col-span-2 flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                        <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Login
                    </a>
                @endguest
                @auth
                    @if(auth()->user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.dashboard') }}" class="col-span-2 flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Akun
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="col-span-2">
                            @csrf
                            <button type="submit" class="w-full rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-700 shadow-soft transition hover:bg-rose-100">Logout</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endunless

<main class="{{ $isAdminArea ? 'h-screen overflow-hidden' : 'mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8 pb-28' }}">
    {{ $slot ?? '' }}
    @yield('content')
</main>

@unless($isAdminArea)
<footer class="fixed bottom-0 left-0 right-0 z-40 border-t border-emerald-100/70 bg-white/90 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 py-6 text-sm text-slate-500 sm:px-6 lg:px-8">
        © 2026 Perpustakaan Digital. All rights reserved.
    </div>
</footer>
@endunless
@stack('scripts')
<script>
    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-mobile-toggle]');
        if (!button) return;

        const targetId = button.getAttribute('data-mobile-toggle');
        const target = targetId ? document.getElementById(targetId) : null;
        if (!target) return;

        const isHidden = target.classList.contains('hidden');
        target.classList.toggle('hidden', !isHidden);
    });
</script>
</body>
</html>
