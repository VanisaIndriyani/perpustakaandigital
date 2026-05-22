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
<body class="{{ $isAdminArea ? 'h-screen overflow-hidden bg-slate-50 text-slate-800 antialiased' : 'min-h-screen bg-gradient-to-b from-emerald-50/60 via-white to-slate-50 text-slate-800 antialiased' }}">
@unless($isAdminArea)
    <div class="sticky top-0 z-50 border-b border-emerald-100/70 bg-white/85 backdrop-blur shadow-sm">
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

            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-medium transition">Home</a>
                <a href="{{ route('koleksi.jurnal') }}" class="{{ request()->routeIs('koleksi.jurnal') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-medium transition">Jurnal</a>
                <a href="{{ route('koleksi.ejurnal') }}" class="{{ request()->routeIs('koleksi.ejurnal') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-medium transition">E-Jurnal</a>
                <a href="{{ route('koleksi.buku') }}" class="{{ request()->routeIs('koleksi.buku') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-medium transition">Buku</a>
                <a href="{{ route('koleksi.ebook') }}" class="{{ request()->routeIs('koleksi.ebook') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-medium transition">E-Book</a>
                <a href="{{ route('koleksi.skripsi') }}" class="{{ request()->routeIs('koleksi.skripsi') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-xl px-3 py-2 text-sm font-medium transition">Skripsi</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}" class="hidden items-center gap-2 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50 md:inline-flex">
                    <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Login
                </a>
                <button type="button" data-mobile-toggle="mobileNav" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white p-2 text-slate-700 shadow-soft transition hover:bg-slate-50 md:hidden">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobileNav" class="hidden border-t border-emerald-100/70 bg-white md:hidden">
            <div class="mx-auto grid max-w-7xl grid-cols-2 gap-2 px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }} rounded-xl px-3 py-2 text-sm font-medium transition">Home</a>
                <a href="{{ route('koleksi.jurnal') }}" class="{{ request()->routeIs('koleksi.jurnal') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }} rounded-xl px-3 py-2 text-sm font-medium transition">Jurnal</a>
                <a href="{{ route('koleksi.ejurnal') }}" class="{{ request()->routeIs('koleksi.ejurnal') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }} rounded-xl px-3 py-2 text-sm font-medium transition">E-Jurnal</a>
                <a href="{{ route('koleksi.buku') }}" class="{{ request()->routeIs('koleksi.buku') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }} rounded-xl px-3 py-2 text-sm font-medium transition">Buku</a>
                <a href="{{ route('koleksi.ebook') }}" class="{{ request()->routeIs('koleksi.ebook') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }} rounded-xl px-3 py-2 text-sm font-medium transition">E-Book</a>
                <a href="{{ route('koleksi.skripsi') }}" class="{{ request()->routeIs('koleksi.skripsi') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }} rounded-xl px-3 py-2 text-sm font-medium transition">Skripsi</a>
                <a href="{{ route('admin.dashboard') }}" class="col-span-2 flex items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                    <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Login Admin
                </a>
            </div>
        </div>
    </div>
@endunless

<main class="{{ $isAdminArea ? 'h-screen overflow-hidden' : 'mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8' }}">
    {{ $slot ?? '' }}
    @yield('content')
</main>

@unless($isAdminArea)
<footer class="border-t border-emerald-100/70 bg-gradient-to-b from-white via-white to-emerald-50/60">
    @if(request()->routeIs('home'))
        <div class="border-b border-emerald-100/70 bg-gradient-to-br from-emerald-600 via-emerald-600 to-emerald-700">
            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <div class="grid gap-6 md:grid-cols-2 md:items-center">
                    <div class="space-y-2 text-white">
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 ring-1 ring-white/20">
                            Repository Digital Kampus
                        </div>
                        <div class="text-2xl font-semibold leading-tight">Butuh akses cepat ke koleksi?</div>
                        <div class="text-sm text-white/90">Masuk ke halaman koleksi dan gunakan search realtime untuk menemukan judul, pengarang, atau tahun.</div>
                    </div>
                    <div class="flex flex-wrap gap-2 md:justify-end">
                        <a href="{{ route('koleksi.buku') }}" class="inline-flex items-center justify-center rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">Cari Buku</a>
                        <a href="{{ route('koleksi.jurnal') }}" class="inline-flex items-center justify-center rounded-2xl bg-emerald-500/30 px-5 py-3 text-sm font-semibold text-white ring-1 ring-white/30 transition hover:bg-emerald-500/40">Cari Jurnal</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-4">
            <div class="space-y-4 md:col-span-2">
                <div class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center overflow-hidden rounded-2xl bg-white ring-1 ring-emerald-100 shadow-soft">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-full w-full object-contain p-1.5">
                    </span>
                    <div>
                        <div class="text-sm font-semibold text-slate-900">{{ config('app.name') }}</div>
                        <div class="text-xs text-slate-500">Repository Digital Kampus</div>
                    </div>
                </div>
                <div class="max-w-prose text-sm text-slate-600">
                    Portal perpustakaan digital untuk jurnal, e-jurnal, buku, e-book, dan skripsi. Desain modern, clean, dan profesional untuk akses cepat di mobile maupun desktop.
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('koleksi.buku') }}" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft ring-1 ring-slate-200/60 transition hover:bg-slate-50">Buku</a>
                    <a href="{{ route('koleksi.jurnal') }}" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft ring-1 ring-slate-200/60 transition hover:bg-slate-50">Jurnal</a>
                    <a href="{{ route('koleksi.skripsi') }}" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft ring-1 ring-slate-200/60 transition hover:bg-slate-50">Skripsi</a>
                </div>
                <div class="grid gap-2 text-sm text-slate-600 sm:grid-cols-2">
                    <div class="flex items-start gap-2">
                        <span class="mt-0.5 text-emerald-700">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21s7-4.4 7-11a7 7 0 1 0-14 0c0 6.6 7 11 7 11Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 10.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <div class="font-semibold text-slate-800">Alamat</div>
                            <div>Jl. Kampus No. 1, Kota</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="mt-0.5 text-emerald-700">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7 12.8 12.8 0 0 0 .7 2.9 2 2 0 0 1-.5 2.1L8.1 10a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5 12.8 12.8 0 0 0 2.9.7A2 2 0 0 1 22 16.9Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <div class="font-semibold text-slate-800">Kontak</div>
                            <div>(000) 0000 0000</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <div class="text-sm font-semibold text-slate-900">Menu</div>
                <div class="grid gap-2 text-sm">
                    <a class="text-slate-600 transition hover:text-slate-900" href="{{ route('home') }}">Home</a>
                    <a class="text-slate-600 transition hover:text-slate-900" href="{{ route('koleksi.jurnal') }}">Jurnal</a>
                    <a class="text-slate-600 transition hover:text-slate-900" href="{{ route('koleksi.ejurnal') }}">E-Jurnal</a>
                    <a class="text-slate-600 transition hover:text-slate-900" href="{{ route('koleksi.buku') }}">Buku</a>
                    <a class="text-slate-600 transition hover:text-slate-900" href="{{ route('koleksi.ebook') }}">E-Book</a>
                    <a class="text-slate-600 transition hover:text-slate-900" href="{{ route('koleksi.skripsi') }}">Skripsi</a>
                </div>
            </div>

            <div class="space-y-3">
                <div class="text-sm font-semibold text-slate-900">Layanan</div>
                <div class="grid gap-2 text-sm text-slate-600">
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                        <span class="font-semibold text-slate-800">Jam Operasional</span>
                        <span>08.00–16.00</span>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                        <span class="font-semibold text-slate-800">Kunjungan</span>
                        <span>Senin–Jumat</span>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Masuk Admin</a>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-emerald-100/70 bg-white/60 backdrop-blur">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-6 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div>© {{ now()->year }} {{ config('app.name') }}. All rights reserved.</div>
            <div class="flex flex-wrap items-center gap-3">
                <a class="text-slate-500 transition hover:text-slate-700" href="{{ route('admin.dashboard') }}">Admin</a>
                <span class="text-slate-300">•</span>
                <span class="text-slate-500">Tema emerald minimalis modern.</span>
            </div>
        </div>
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
