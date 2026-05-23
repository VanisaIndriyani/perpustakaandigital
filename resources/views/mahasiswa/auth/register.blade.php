@extends('layouts.app')

@section('content')
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-2 lg:items-stretch">
        <div class="relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="absolute -left-20 -top-20 h-56 w-56 rounded-full bg-emerald-50 blur-2xl"></div>
            <div class="relative space-y-6">
                <div class="space-y-1">
                    <div class="text-sm font-semibold text-emerald-700">Mahasiswa</div>
                    <h1 class="text-2xl font-semibold text-slate-900">Daftar Akun</h1>
                    <div class="text-sm text-slate-600">Buat akun untuk peminjaman dan Turnitin.</div>
                </div>

                @if($errors->any())
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        <div class="font-semibold">Periksa lagi input kamu:</div>
                        <ul class="mt-1 list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="grid gap-4 md:grid-cols-2" method="POST" action="{{ route('register.store') }}">
                    @csrf

                    <div class="space-y-1 md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700" for="name">Nama</label>
                        <input id="name" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Nama lengkap" required autofocus>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700" for="nim">NIM</label>
                        <input id="nim" name="nim" value="{{ old('nim') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Contoh: 2026001" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700" for="phone">No. HP (opsional)</label>
                        <input id="phone" name="phone" value="{{ old('phone') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="08xxxxxxxxxx" inputmode="tel">
                    </div>

                    <div class="space-y-1 md:col-span-2">
                        <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="nama@email.com" required>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700" for="password">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Buat password" required>
                            <button type="button" data-toggle-password="password" class="absolute inset-y-0 right-0 grid w-12 place-items-center text-slate-500 transition hover:text-slate-800" aria-label="Tampilkan password">
                                <svg data-eye="open" viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg data-eye="closed" viewBox="0 0 24 24" fill="none" class="hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3l18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M10.6 10.6a3 3 0 0 0 4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9.2 5.3A10.6 10.6 0 0 1 12 5c6.5 0 10 7 10 7a18.3 18.3 0 0 1-2.2 3.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.2 6.2C3.3 8.5 2 12 2 12s3.5 7 10 7c1.1 0 2.1-.2 3-.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700" for="password_confirmation">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Ulangi password" required>
                            <button type="button" data-toggle-password="password_confirmation" class="absolute inset-y-0 right-0 grid w-12 place-items-center text-slate-500 transition hover:text-slate-800" aria-label="Tampilkan password">
                                <svg data-eye="open" viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <svg data-eye="closed" viewBox="0 0 24 24" fill="none" class="hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3l18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M10.6 10.6a3 3 0 0 0 4.2 4.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9.2 5.3A10.6 10.6 0 0 1 12 5c6.5 0 10 7 10 7a18.3 18.3 0 0 1-2.2 3.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.2 6.2C3.3 8.5 2 12 2 12s3.5 7 10 7c1.1 0 2.1-.2 3-.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 md:col-span-2">
                        <button type="submit" class="flex-1 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Daftar</button>
                        <a href="{{ route('login') }}" class="flex-1 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Login</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-3xl border border-emerald-100/70 bg-gradient-to-br from-emerald-600 via-emerald-600 to-emerald-700 p-6 text-white shadow-soft sm:p-8">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute -bottom-24 -left-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>

            <div class="relative space-y-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center overflow-hidden rounded-2xl bg-white/10 ring-1 ring-white/20">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-full w-full object-contain p-1.5">
                    </span>
                    <div class="leading-tight">
                        <div class="text-sm font-semibold">{{ config('app.name') }}</div>
                        <div class="text-xs text-white/80">Repository Digital Kampus</div>
                    </div>
                </a>

                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 ring-1 ring-white/20">
                        Benefit Akun
                    </div>
                    <div class="text-2xl font-semibold leading-tight">Satu akun untuk semua layanan.</div>
                    <div class="text-sm text-white/90">Setelah daftar, kamu bisa mengajukan peminjaman koleksi serta submit Turnitin dan melihat statusnya.</div>
                </div>

                <div class="grid gap-3 text-sm text-white/90">
                    <div class="flex items-start gap-3 rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15">
                        <span class="mt-0.5">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <div>
                            <div class="font-semibold">Akses Koleksi</div>
                            <div class="text-white/80">Cari judul, pengarang, dan tahun dengan cepat.</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15">
                        <span class="mt-0.5">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <div>
                            <div class="font-semibold">Pantau Status</div>
                            <div class="text-white/80">Lihat progres pengajuan peminjaman dan Turnitin.</div>
                        </div>
                    </div>
                </div>

                <div class="text-xs text-white/80">Sudah punya akun? Klik tombol Login di kiri.</div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-toggle-password]');
        if (!button) return;

        const targetId = button.getAttribute('data-toggle-password');
        const input = targetId ? document.getElementById(targetId) : null;
        if (!input) return;

        const isPassword = input.getAttribute('type') === 'password';
        input.setAttribute('type', isPassword ? 'text' : 'password');

        const openIcon = button.querySelector('[data-eye="open"]');
        const closedIcon = button.querySelector('[data-eye="closed"]');
        if (openIcon) openIcon.classList.toggle('hidden', isPassword);
        if (closedIcon) closedIcon.classList.toggle('hidden', !isPassword);

        button.setAttribute('aria-label', isPassword ? 'Sembunyikan password' : 'Tampilkan password');
    });
</script>
@endpush
