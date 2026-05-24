@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Mahasiswa</div>
                <div class="text-2xl font-semibold text-slate-900">Data Mahasiswa</div>
                <div class="mt-2 text-sm text-slate-600">Daftar akun mahasiswa yang terdaftar dan aktivitas login terakhir.</div>
            </div>
        </div>

        <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['total'] ?? 0 }}</div>
            </div>
            <div class="rounded-3xl border border-emerald-200/70 bg-emerald-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Pernah Login</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['logged_in'] ?? 0 }}</div>
            </div>
            <div class="rounded-3xl border border-amber-200/70 bg-amber-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-amber-700">Belum Login</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['never_login'] ?? 0 }}</div>
            </div>
            <div class="rounded-3xl border border-sky-200/70 bg-sky-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-sky-700">Aktif 7 Hari</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['active_7d'] ?? 0 }}</div>
            </div>
        </div>

        <form class="mt-6 grid gap-3 md:grid-cols-4" method="GET" action="{{ route('admin.mahasiswa.index') }}">
            <input name="q" value="{{ $q }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4 md:col-span-3" placeholder="Cari nama / email / NIM / no HP...">
            <div class="flex flex-wrap gap-2">
                <button class="flex-1 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700" type="submit">Cari</button>
                <a class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50" href="{{ route('admin.mahasiswa.index') }}">Reset</a>
            </div>
        </form>

        <div class="mt-6 grid gap-3 lg:grid-cols-2">
            @forelse($mahasiswas as $mhs)
                @php
                    $recent = $mhs->last_login_at && $mhs->last_login_at->greaterThanOrEqualTo(now()->subDays(7));
                    $never = is_null($mhs->last_login_at);
                    $cardClass = $never
                        ? 'border-amber-200/70 bg-gradient-to-br from-amber-50/70 via-white to-white'
                        : ($recent ? 'border-emerald-200/70 bg-gradient-to-br from-emerald-50/70 via-white to-white' : 'border-slate-100 bg-white');
                @endphp
                <div class="rounded-3xl border p-5 shadow-soft {{ $cardClass }}">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-slate-900">{{ $mhs->name }}</div>
                            <div class="mt-1 truncate text-xs text-slate-600">{{ $mhs->nim ?? '-' }} • {{ $mhs->email }}</div>
                        </div>
                        @if($never)
                            <span class="shrink-0 rounded-full bg-amber-50 px-3 py-1 text-xs font-semibold text-amber-800 ring-1 ring-amber-200/70">Belum Login</span>
                        @elseif($recent)
                            <span class="shrink-0 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-800 ring-1 ring-emerald-200/70">Aktif</span>
                        @else
                            <span class="shrink-0 rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60">Pernah Login</span>
                        @endif
                    </div>

                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="text-xs font-semibold text-slate-500">Kontak</div>
                            <div class="mt-1 truncate text-sm font-semibold text-slate-900">{{ $mhs->phone ?? '-' }}</div>
                        </div>
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-600 ring-1 ring-slate-200/60">
                            <div class="text-xs font-semibold text-slate-500">Waktu</div>
                            <div class="mt-1 space-y-1">
                                <div>Daftar: {{ $mhs->created_at?->format('d/m/Y H:i') }} WIB</div>
                                <div>Login: {{ $mhs->last_login_at ? $mhs->last_login_at->format('d/m/Y H:i') . ' WIB' : '—' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-600 lg:col-span-2">
                    Belum ada akun mahasiswa.
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $mahasiswas->links() }}
        </div>
    </div>
@endsection
