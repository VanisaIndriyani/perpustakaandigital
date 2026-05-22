@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Profil</div>
                <div class="text-2xl font-semibold text-slate-900">Edit Profil Admin</div>
                <div class="mt-2 text-sm text-slate-600">Ubah nama, email, dan password akun admin.</div>
            </div>
        </div>

        @if(session('status'))
            <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-6 space-y-6" method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="name">Nama</label>
                    <input id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('name')
                        <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('email')
                        <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="rounded-3xl border border-slate-100 bg-slate-50 p-5">
                <div class="text-sm font-semibold text-slate-900">Ubah Password (opsional)</div>
                <div class="mt-1 text-sm text-slate-600">Kosongkan jika tidak ingin mengganti password.</div>

                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700" for="password">Password Baru</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Minimal 8 karakter">
                            <button type="button" data-toggle-password="password" class="absolute inset-y-0 right-0 inline-flex items-center justify-center rounded-r-2xl px-4 text-slate-500 transition hover:text-slate-700" aria-label="Tampilkan password">
                                <svg data-eye viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7S2.5 12 2.5 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                </svg>
                                <svg data-eye-off viewBox="0 0 24 24" fill="none" class="hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3l18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M10.6 10.7a2.5 2.5 0 0 0 3.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9.9 5.4A10.6 10.6 0 0 1 12 5c6 0 9.5 7 9.5 7a17.8 17.8 0 0 1-4.1 4.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.6 6.6C4.1 8.5 2.5 12 2.5 12s3.5 7 9.5 7c1.1 0 2.1-.2 3.1-.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700" for="password_confirmation">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Ulangi password">
                            <button type="button" data-toggle-password="password_confirmation" class="absolute inset-y-0 right-0 inline-flex items-center justify-center rounded-r-2xl px-4 text-slate-500 transition hover:text-slate-700" aria-label="Tampilkan password">
                                <svg data-eye viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7S2.5 12 2.5 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                </svg>
                                <svg data-eye-off viewBox="0 0 24 24" fill="none" class="hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3l18 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M10.6 10.7a2.5 2.5 0 0 0 3.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9.9 5.4A10.6 10.6 0 0 1 12 5c6 0 9.5 7 9.5 7a17.8 17.8 0 0 1-4.1 4.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.6 6.6C4.1 8.5 2.5 12 2.5 12s3.5 7 9.5 7c1.1 0 2.1-.2 3.1-.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Simpan</button>
                <a href="{{ route('admin.dashboard') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        (function () {
            const buttons = document.querySelectorAll('[data-toggle-password]');
            buttons.forEach((button) => {
                const inputId = button.getAttribute('data-toggle-password');
                const input = document.getElementById(inputId);
                if (!input) return;

                const eye = button.querySelector('[data-eye]');
                const eyeOff = button.querySelector('[data-eye-off]');

                const sync = () => {
                    const isText = input.type === 'text';
                    if (eye) eye.classList.toggle('hidden', isText);
                    if (eyeOff) eyeOff.classList.toggle('hidden', !isText);
                    button.setAttribute('aria-label', isText ? 'Sembunyikan password' : 'Tampilkan password');
                };

                button.addEventListener('click', () => {
                    input.type = input.type === 'password' ? 'text' : 'password';
                    sync();
                });

                sync();
            });
        })();
    </script>
@endpush
