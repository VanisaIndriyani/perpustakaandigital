@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">User</div>
                <div class="text-2xl font-semibold text-slate-900">Tambah User</div>
            </div>
            <a href="{{ route('admin.user.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
        </div>

        <form class="mt-6 space-y-6" method="POST" action="{{ route('admin.user.store') }}">
            @csrf

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="name">Nama Lengkap</label>
                    <input id="name" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('name') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('email') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="role">Role</label>
                    <select id="role" name="role" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                        <option value="" disabled @selected(old('role') === null)>Pilih role</option>
                        <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                        <option value="staf" @selected(old('role') === 'staf')>Staf</option>
                        <option value="mahasiswa" @selected(old('role') === 'mahasiswa')>Mahasiswa</option>
                    </select>
                    @error('role') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="nim">NIM (Hanya untuk Mahasiswa)</label>
                    <input id="nim" name="nim" value="{{ old('nim') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                    @error('nim') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="phone">Nomor Telepon</label>
                    <input id="phone" name="phone" value="{{ old('phone') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                    @error('phone') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1"></div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="password">Password</label>
                    <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('password') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Simpan</button>
                <a href="{{ route('admin.user.index') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Batal</a>
            </div>
        </form>
    </div>
@endsection
