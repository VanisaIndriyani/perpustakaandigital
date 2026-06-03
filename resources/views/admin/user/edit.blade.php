@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">User</div>
                <div class="text-2xl font-semibold text-slate-900">Edit User</div>
            </div>
            <a href="{{ route('admin.user.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
        </div>

        <form class="mt-6 space-y-6" method="POST" action="{{ route('admin.user.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="name">Nama Lengkap</label>
                    <input id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('name') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('email') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="role">Role</label>
                    <select id="role" name="role" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Admin</option>
                        <option value="staf" @selected(old('role', $user->role) === 'staf')>Staf</option>
                        <option value="mahasiswa" @selected(old('role', $user->role) === 'mahasiswa')>Mahasiswa</option>
                    </select>
                    @error('role') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="nim">NIM (Hanya untuk Mahasiswa)</label>
                    <input id="nim" name="nim" value="{{ old('nim', $user->nim) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                    @error('nim') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="phone">Nomor Telepon</label>
                    <input id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                    @error('phone') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="kta">Upload KTA Perpus</label>
                    <input id="kta" name="kta" type="file" accept="image/*" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                    @error('kta') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                    @if($user->kta_url)
                        <div class="mt-2 flex items-center gap-3 rounded-2xl bg-slate-50 p-3 ring-1 ring-slate-200/60">
                            <img src="{{ $user->kta_url }}" alt="KTA" class="h-12 w-12 rounded-lg object-cover">
                            <div class="text-xs font-semibold text-slate-600">KTA saat ini</div>
                        </div>
                    @endif
                </div>

                <div class="space-y-1 md:col-span-2">
                    <div class="rounded-2xl bg-amber-50 p-4 ring-1 ring-amber-200/60">
                        <div class="text-xs font-semibold text-amber-700">Catatan:</div>
                        <div class="text-xs text-slate-600">Kosongkan password jika tidak ingin mengubahnya.</div>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="password">Password Baru</label>
                    <input id="password" name="password" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                    @error('password') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Perbarui</button>
                <a href="{{ route('admin.user.index') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Batal</a>
            </div>
        </form>
    </div>
@endsection
