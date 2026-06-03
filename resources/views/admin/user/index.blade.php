@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">User</div>
                <div class="text-2xl font-semibold text-slate-900">Manajemen User</div>
                <div class="mt-2 text-sm text-slate-600">Kelola semua akun pengguna (Admin, Staff, Mahasiswa).</div>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.user.export.pdf', ['q' => $q, 'role' => $role]) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M8 11l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                    Export PDF
                </a>
                <a href="{{ route('admin.user.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Tambah User
                </a>
            </div>
        </div>

        @if(session('status'))
            <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mt-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form class="mt-6 grid gap-3 md:grid-cols-5" method="GET" action="{{ route('admin.user.index') }}">
            <input name="q" value="{{ $q }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4 md:col-span-3" placeholder="Cari nama / email / NIM...">
            <select name="role" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                <option value="">Semua Role</option>
                <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staf" {{ $role === 'staf' ? 'selected' : '' }}>Staf</option>
                <option value="mahasiswa" {{ $role === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                <option value="dosen" {{ $role === 'dosen' ? 'selected' : '' }}>Dosen</option>
            </select>
            <div class="flex flex-wrap gap-2">
                <button class="flex-1 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700" type="submit">Cari</button>
                <a class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50" href="{{ route('admin.user.index') }}">Reset</a>
            </div>
        </form>

        <div class="mt-6 overflow-hidden rounded-3xl border border-slate-100 shadow-soft">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Nama & Email</th>
                            <th class="px-6 py-4">Password</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">NIM / Phone</th>
                            <th class="px-6 py-4">Login Terakhir</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">{{ $user->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->password_plain)
                                        <code class="rounded bg-emerald-50 px-2 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200/60">
                                            {{ $user->password_plain }}
                                        </code>
                                    @else
                                        <span class="text-xs text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $roleClass = match($user->role) {
                                            'admin' => 'bg-rose-50 text-rose-700 ring-rose-200/60',
                                            'staf' => 'bg-sky-50 text-sky-700 ring-sky-200/60',
                                            'dosen' => 'bg-amber-50 text-amber-700 ring-amber-200/60',
                                            default => 'bg-emerald-50 text-emerald-700 ring-emerald-200/60',
                                        };
                                    @endphp
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 {{ $roleClass }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    @if($user->role === 'mahasiswa')
                                        <div class="text-xs">NPM: {{ $user->nim ?? '-' }}</div>
                                    @elseif($user->role === 'dosen')
                                        <div class="text-xs">NUPTK: {{ $user->nim ?? '-' }}</div>
                                    @else
                                        <div class="text-xs">NIM/ID: {{ $user->nim ?? '-' }}</div>
                                    @endif
                                    <div class="text-xs">Telp: {{ $user->phone ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs text-slate-500">
                                    {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Belum pernah' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.user.edit', $user) }}" class="rounded-xl border border-slate-200 bg-white p-2 text-slate-600 shadow-soft transition hover:bg-slate-50 hover:text-emerald-600">
                                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.user.destroy', $user) }}" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-xl border border-rose-200 bg-rose-50 p-2 text-rose-600 shadow-soft transition hover:bg-rose-100">
                                                    <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-sm text-slate-500">
                                    User tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@endsection
