@extends('admin.layout')

@section('admin-content')
    @php
        $badge = [
            'requested' => 'bg-amber-50 text-amber-800 ring-amber-200/70',
            'approved' => 'bg-sky-50 text-sky-800 ring-sky-200/70',
            'rejected' => 'bg-rose-50 text-rose-700 ring-rose-200/70',
            'borrowed' => 'bg-indigo-50 text-indigo-800 ring-indigo-200/70',
            'returned' => 'bg-emerald-50 text-emerald-800 ring-emerald-200/70',
        ];
        $cardBg = [
            'requested' => 'border-amber-200/70 bg-gradient-to-br from-amber-50/70 via-white to-white',
            'approved' => 'border-sky-200/70 bg-gradient-to-br from-sky-50/70 via-white to-white',
            'rejected' => 'border-rose-200/70 bg-gradient-to-br from-rose-50/70 via-white to-white',
            'borrowed' => 'border-indigo-200/70 bg-gradient-to-br from-indigo-50/70 via-white to-white',
            'returned' => 'border-emerald-200/70 bg-gradient-to-br from-emerald-50/70 via-white to-white',
        ];
    @endphp

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Peminjaman</div>
                <div class="text-2xl font-semibold text-slate-900">Kelola Peminjaman</div>
                <div class="mt-2 text-sm text-slate-600">Kelola pengajuan peminjaman dari mahasiswa.</div>
            </div>
        </div>

        <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-6">
            <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-soft">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total</div>
                        <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['total'] ?? 0 }}</div>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-slate-50 text-slate-700 ring-1 ring-slate-200/60">
                        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 19.5V6.5A2.5 2.5 0 0 1 6.5 4H18a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.5.5H6.5A2.5 2.5 0 0 1 4 19.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M6.5 4H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="rounded-3xl border border-amber-200/70 bg-amber-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-amber-700">Requested</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['requested'] ?? 0 }}</div>
            </div>
            <div class="rounded-3xl border border-sky-200/70 bg-sky-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-sky-700">Approved</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['approved'] ?? 0 }}</div>
            </div>
            <div class="rounded-3xl border border-indigo-200/70 bg-indigo-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-indigo-700">Borrowed</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['borrowed'] ?? 0 }}</div>
            </div>
            <div class="rounded-3xl border border-emerald-200/70 bg-emerald-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Returned</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['returned'] ?? 0 }}</div>
            </div>
            <div class="rounded-3xl border border-rose-200/70 bg-rose-50 p-5 shadow-soft">
                <div class="text-xs font-semibold uppercase tracking-wide text-rose-700">Rejected</div>
                <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['rejected'] ?? 0 }}</div>
            </div>
        </div>

        @if(session('status'))
            <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-6 grid gap-3 md:grid-cols-4" method="GET" action="{{ route('admin.peminjaman.index') }}">
            <input name="q" value="{{ $q }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4 md:col-span-2" placeholder="Cari nama / email / nim / judul...">
            <select name="status" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                <option value="">Semua Status</option>
                @foreach($statusOptions as $key => $label)
                    <option value="{{ $key }}" @selected($status === $key)>{{ $label }}</option>
                @endforeach
            </select>
            <div class="flex flex-wrap gap-2">
                <button class="flex-1 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700" type="submit">Terapkan</button>
                <a class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50" href="{{ route('admin.peminjaman.index') }}">Reset</a>
                <a class="flex-1 rounded-2xl border border-emerald-200 bg-white px-4 py-3 text-center text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50" href="{{ route('admin.peminjaman.export.pdf', ['q' => $q, 'status' => $status]) }}">Export PDF</a>
            </div>
        </form>

        <div class="mt-6 grid gap-3 lg:grid-cols-2">
            @forelse($peminjamans as $item)
                <div class="rounded-3xl border p-5 shadow-soft {{ $cardBg[$item->status] ?? 'border-slate-100 bg-white' }}">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-slate-900">{{ $item->koleksi?->judul }}</div>
                            <div class="mt-1 truncate text-xs text-slate-600">{{ $item->koleksi?->pengarang }}</div>
                        </div>
                        <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $badge[$item->status] ?? 'bg-slate-50 text-slate-700 ring-slate-200/60' }}">
                            {{ $statusOptions[$item->status] ?? $item->status }}
                        </span>
                    </div>

                    <div class="mt-4 grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="text-xs font-semibold text-slate-500">Mahasiswa</div>
                            <div class="mt-1 truncate text-sm font-semibold text-slate-900">{{ $item->user?->name }}</div>
                            <div class="mt-1 truncate text-xs text-slate-600">{{ $item->user?->nim }} • {{ $item->user?->email }}</div>
                        </div>
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-600 ring-1 ring-slate-200/60">
                            <div class="text-xs font-semibold text-slate-500">Tanggal</div>
                            <div class="mt-1 space-y-1">
                                <div>Diajukan: {{ $item->created_at->format('d/m/Y H:i') }}</div>
                                @if($item->tanggal_pinjam)
                                    <div>Pinjam: {{ $item->tanggal_pinjam->format('d/m/Y') }}</div>
                                @endif
                                @if($item->tanggal_jatuh_tempo)
                                    <div>Jatuh tempo: {{ $item->tanggal_jatuh_tempo->format('d/m/Y') }}</div>
                                @endif
                                @if($item->tanggal_kembali)
                                    <div>Kembali: {{ $item->tanggal_kembali->format('d/m/Y') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($item->catatan_admin)
                        <div class="mt-3 rounded-2xl bg-white px-4 py-3 text-xs text-slate-700 ring-1 ring-slate-200/60">
                            <div class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Catatan Admin</div>
                            <div class="mt-1 break-words">{{ $item->catatan_admin }}</div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <button
                            type="button"
                            data-admin-modal-open="peminjaman"
                            data-action="{{ route('admin.peminjaman.update', $item) }}"
                            data-user="{{ $item->user?->name }}"
                            data-title="{{ $item->koleksi?->judul }}"
                            data-status="{{ $item->status }}"
                            data-pinjam="{{ optional($item->tanggal_pinjam)->format('Y-m-d') }}"
                            data-jatuh="{{ optional($item->tanggal_jatuh_tempo)->format('Y-m-d') }}"
                            data-kembali="{{ optional($item->tanggal_kembali)->format('Y-m-d') }}"
                            data-catatan="{{ $item->catatan_admin }}"
                            class="w-full rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700"
                        >
                            Update
                        </button>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-600 lg:col-span-2">
                    Belum ada pengajuan peminjaman.
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $peminjamans->links() }}
        </div>
    </div>

    <div id="peminjamanModal" class="fixed inset-0 z-[60] hidden">
        <div data-admin-modal-close="peminjaman" class="absolute inset-0 bg-slate-900/40"></div>
        <div class="absolute inset-x-0 top-10 mx-auto w-full max-w-2xl px-4 sm:px-6">
            <div class="rounded-3xl border border-slate-100 bg-white shadow-soft">
                <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                    <div class="min-w-0">
                        <div class="text-sm font-semibold text-emerald-700">Update Peminjaman</div>
                        <div id="peminjamanModalTitle" class="mt-1 truncate text-lg font-semibold text-slate-900"></div>
                        <div id="peminjamanModalUser" class="mt-1 truncate text-sm text-slate-600"></div>
                    </div>
                    <button type="button" data-admin-modal-close="peminjaman" class="grid h-10 w-10 place-items-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-soft transition hover:bg-slate-50" aria-label="Tutup">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M6 6l12 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>

                <form id="peminjamanModalForm" method="POST" class="grid gap-4 px-6 py-6">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="space-y-1 sm:col-span-2">
                            <div class="text-sm font-semibold text-slate-700">Status</div>
                            <select id="peminjaman_status" name="status" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                                @foreach($statusOptions as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm font-semibold text-slate-700">Tanggal Pinjam</div>
                            <input id="peminjaman_pinjam" type="date" name="tanggal_pinjam" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm font-semibold text-slate-700">Jatuh Tempo</div>
                            <input id="peminjaman_jatuh" type="date" name="tanggal_jatuh_tempo" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                        </div>
                        <div class="space-y-1 sm:col-span-2">
                            <div class="text-sm font-semibold text-slate-700">Tanggal Kembali</div>
                            <input id="peminjaman_kembali" type="date" name="tanggal_kembali" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                        </div>
                        <div class="space-y-1 sm:col-span-2">
                            <div class="text-sm font-semibold text-slate-700">Catatan Admin (opsional)</div>
                            <input id="peminjaman_catatan" name="catatan_admin" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Tulis catatan singkat...">
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 pt-2">
                        <button type="submit" class="flex-1 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Simpan</button>
                        <button type="button" data-admin-modal-close="peminjaman" class="flex-1 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const modal = document.getElementById('peminjamanModal');
        const form = document.getElementById('peminjamanModalForm');
        const title = document.getElementById('peminjamanModalTitle');
        const user = document.getElementById('peminjamanModalUser');
        const status = document.getElementById('peminjaman_status');
        const pinjam = document.getElementById('peminjaman_pinjam');
        const jatuh = document.getElementById('peminjaman_jatuh');
        const kembali = document.getElementById('peminjaman_kembali');
        const catatan = document.getElementById('peminjaman_catatan');

        const open = (button) => {
            if (!modal || !form) return;
            const action = button.getAttribute('data-action');
            if (action) form.setAttribute('action', action);

            if (title) title.textContent = button.getAttribute('data-title') || '';
            if (user) user.textContent = button.getAttribute('data-user') || '';
            if (status) status.value = button.getAttribute('data-status') || 'requested';
            if (pinjam) pinjam.value = button.getAttribute('data-pinjam') || '';
            if (jatuh) jatuh.value = button.getAttribute('data-jatuh') || '';
            if (kembali) kembali.value = button.getAttribute('data-kembali') || '';
            if (catatan) catatan.value = button.getAttribute('data-catatan') || '';

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        };

        const close = () => {
            if (!modal) return;
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        document.addEventListener('click', (event) => {
            const openBtn = event.target.closest('[data-admin-modal-open="peminjaman"]');
            if (openBtn) return open(openBtn);

            const closeBtn = event.target.closest('[data-admin-modal-close="peminjaman"]');
            if (closeBtn) return close();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;
            if (!modal || modal.classList.contains('hidden')) return;
            close();
        });
    })();
</script>
@endpush
