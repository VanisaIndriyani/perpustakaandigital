@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-md">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="space-y-2">
                <div class="text-sm font-semibold text-emerald-700">Admin Login</div>
                <h1 class="text-2xl font-semibold text-slate-900">Masuk Panel Admin</h1>
                <p class="text-sm text-slate-600">Gunakan akun admin yang sudah dibuat di database.</p>
            </div>

            <form class="mt-6 space-y-4" method="POST" action="{{ route('admin.login.store') }}">
                @csrf

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="admin@perpustakaan.test" required>
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
                    Remember me
                </label>

                <button type="submit" class="w-full rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">
                    Masuk
                </button>
            </form>
        </div>
    </div>
@endsection

