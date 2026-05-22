@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-md">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="flex items-start gap-4">
                <div class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="space-y-1">
                    <div class="text-sm font-semibold text-emerald-700">Mahasiswa</div>
                    <h1 class="text-2xl font-semibold text-slate-900">Login</h1>
                    <div class="text-sm text-slate-600">Masuk untuk mengajukan peminjaman dan Turnitin.</div>
                </div>
            </div>

            <form class="mt-6 space-y-4" method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="nama@email.com" required>
                    @error('email')
                        <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="password">Password</label>
                    <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="••••••••" required>
                    @error('password')
                        <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                    @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-200">
                    Ingat saya
                </label>

                <button type="submit" class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">
                    Masuk
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-slate-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:text-emerald-800">Daftar</a>
            </div>
        </div>
    </div>
@endsection

