@extends('layouts.app')

@section('content')
    <div class="h-full overflow-hidden">
        <div class="flex h-full">
            <div id="adminSidebarDrawer" class="hidden fixed inset-0 z-50 md:hidden">
                <div data-mobile-toggle="adminSidebarDrawer" class="absolute inset-0 bg-slate-900/40"></div>
                <aside class="absolute inset-y-0 left-0 w-72 overflow-y-auto bg-white shadow-xl">
                    <div class="flex h-full flex-col border-r border-slate-100">
                        <div class="border-b border-emerald-100/70 px-5 py-5">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                                <span class="grid h-10 w-10 place-items-center overflow-hidden rounded-2xl bg-white ring-1 ring-emerald-100 shadow-soft">
                                    <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-full w-full object-contain p-1.5">
                                </span>
                                <div class="leading-tight">
                                    <div class="text-sm font-semibold text-slate-900">Admin Panel</div>
                                    <div class="text-xs text-slate-500">{{ config('app.name') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="flex-1 space-y-6 px-4 py-5">
                            <div class="rounded-2xl bg-emerald-50/70 p-4 ring-1 ring-emerald-200/60">
                                <div class="text-xs font-semibold text-emerald-700">Login sebagai</div>
                                <div class="mt-1 text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-slate-600">{{ auth()->user()->email }}</div>
                            </div>

                            <div class="space-y-1">
                                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 13h6v7H4v-7Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                        <path d="M14 4h6v16h-6V4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                        <path d="M4 4h6v6H4V4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                        <path d="M14 13h6v7h-6v-7Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    </svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('admin.koleksi.index') }}" class="{{ request()->routeIs('admin.koleksi.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Koleksi
                                </a>
                                <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 13V7a2 2 0 0 0-2-2H12l-2 2H6a2 2 0 0 0-2 2v4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4 13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M8 19h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    </svg>
                                    Kategori
                                </a>
                                <a href="{{ route('admin.peminjaman.index') }}" class="{{ request()->routeIs('admin.peminjaman.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 8h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    </svg>
                                    Peminjaman
                                </a>
                                <a href="{{ route('admin.turnitin.index') }}" class="{{ request()->routeIs('admin.turnitin.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-8-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8 13h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M8 17h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    </svg>
                                    Turnitin
                                </a>
                                <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Profil
                                </a>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 px-4 py-4">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="w-full rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 shadow-soft transition hover:bg-rose-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </aside>
            </div>

            <aside class="hidden h-full w-72 shrink-0 overflow-y-auto border-r border-slate-100 bg-white md:block">
                <div class="flex h-full flex-col">
                    <div class="border-b border-emerald-100/70 px-5 py-5">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                            <span class="grid h-10 w-10 place-items-center overflow-hidden rounded-2xl bg-white ring-1 ring-emerald-100 shadow-soft">
                                <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-full w-full object-contain p-1.5">
                            </span>
                            <div class="leading-tight">
                                <div class="text-sm font-semibold text-slate-900">Admin Panel</div>
                                <div class="text-xs text-slate-500">{{ config('app.name') }}</div>
                            </div>
                        </a>
                    </div>

                    <div class="flex-1 space-y-6 px-4 py-5">
                        <div class="rounded-2xl bg-emerald-50/70 p-4 ring-1 ring-emerald-200/60">
                            <div class="text-xs font-semibold text-emerald-700">Login sebagai</div>
                            <div class="mt-1 text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-slate-600">{{ auth()->user()->email }}</div>
                        </div>

                        <div class="space-y-1">
                            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 13h6v7H4v-7Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    <path d="M14 4h6v16h-6V4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    <path d="M4 4h6v6H4V4Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    <path d="M14 13h6v7h-6v-7Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                </svg>
                                Dashboard
                            </a>
                            <a href="{{ route('admin.koleksi.index') }}" class="{{ request()->routeIs('admin.koleksi.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Koleksi
                            </a>
                            <a href="{{ route('admin.kategori.index') }}" class="{{ request()->routeIs('admin.kategori.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 13V7a2 2 0 0 0-2-2H12l-2 2H6a2 2 0 0 0-2 2v4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M4 13a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M8 19h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                                Kategori
                            </a>
                            <a href="{{ route('admin.peminjaman.index') }}" class="{{ request()->routeIs('admin.peminjaman.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 8h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                                Peminjaman
                            </a>
                            <a href="{{ route('admin.turnitin.index') }}" class="{{ request()->routeIs('admin.turnitin.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-8-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 13h8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M8 17h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                                Turnitin
                            </a>
                            <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'bg-emerald-600 text-white' : 'text-slate-700 hover:bg-slate-50' }} flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Profil
                            </a>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 px-4 py-4">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 shadow-soft transition hover:bg-rose-100">Logout</button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="flex-1 overflow-y-auto">
                <div class="border-b border-slate-100 bg-white/70 backdrop-blur md:hidden">
                    <div class="flex items-center justify-between px-4 py-3">
                        <button type="button" data-mobile-toggle="adminSidebarDrawer" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white p-2 text-slate-700 shadow-soft transition hover:bg-slate-50">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </button>
                        <div class="text-sm font-semibold text-slate-900">Admin Panel</div>
                        <div class="h-10 w-10"></div>
                    </div>
                </div>

                <div class="mx-auto max-w-6xl px-4 py-6 sm:px-6 sm:py-8">
                    @yield('admin-content')
                </div>
            </div>
        </div>
    </div>
@endsection
