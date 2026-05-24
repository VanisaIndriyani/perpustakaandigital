@extends('admin.layout')

@section('admin-content')
    @php
        $badge = [
            'submitted' => 'bg-amber-50 text-amber-800 ring-amber-200/70',
            'checking' => 'bg-sky-50 text-sky-800 ring-sky-200/70',
            'completed' => 'bg-emerald-50 text-emerald-800 ring-emerald-200/70',
        ];
        $cardBg = [
            'submitted' => 'border-amber-200/70 bg-gradient-to-br from-amber-50/70 via-white to-white',
            'checking' => 'border-sky-200/70 bg-gradient-to-br from-sky-50/70 via-white to-white',
            'completed' => 'border-emerald-200/70 bg-gradient-to-br from-emerald-50/70 via-white to-white',
        ];
    @endphp

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Turnitin</div>
                <div class="text-2xl font-semibold text-slate-900">Kelola Turnitin</div>
                <div class="mt-2 text-sm text-slate-600">Kelola pengajuan, score similarity, dan laporan.</div>
            </div>
        </div>

        <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-soft">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-slate-500">Total</div>
                        <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['total'] ?? 0 }}</div>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-slate-50 text-slate-700 ring-1 ring-slate-200/60">
                        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="rounded-3xl border border-amber-200/70 bg-amber-50 p-5 shadow-soft">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-amber-700">Submitted</div>
                        <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['submitted'] ?? 0 }}</div>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-white/60 text-amber-800 ring-1 ring-amber-200/70">
                        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3v12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M8 9l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4 21h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="rounded-3xl border border-sky-200/70 bg-sky-50 p-5 shadow-soft">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-sky-700">Checking</div>
                        <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['checking'] ?? 0 }}</div>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-white/60 text-sky-800 ring-1 ring-sky-200/70">
                        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2a10 10 0 1 0 10 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M22 4v6h-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="rounded-3xl border border-emerald-200/70 bg-emerald-50 p-5 shadow-soft">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Completed</div>
                        <div class="mt-1 text-2xl font-semibold text-slate-900">{{ $summary['completed'] ?? 0 }}</div>
                    </div>
                    <span class="grid h-11 w-11 place-items-center rounded-2xl bg-white/60 text-emerald-800 ring-1 ring-emerald-200/70">
                        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        @if(session('status'))
            <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-6 grid gap-3 md:grid-cols-4" method="GET" action="{{ route('admin.turnitin.index') }}">
            <input name="q" value="{{ $q }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4 md:col-span-2" placeholder="Cari judul / nama / email / nim...">
            <select name="status" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                <option value="">Semua Status</option>
                @foreach($statusOptions as $key => $label)
                    <option value="{{ $key }}" @selected($status === $key)>{{ $label }}</option>
                @endforeach
            </select>
            <div class="flex flex-wrap gap-2">
                <button class="flex-1 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700" type="submit">Terapkan</button>
                <a class="flex-1 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50" href="{{ route('admin.turnitin.index') }}">Reset</a>
                <a class="flex-1 rounded-2xl border border-emerald-200 bg-white px-4 py-3 text-center text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50" href="{{ route('admin.turnitin.export.pdf', ['q' => $q, 'status' => $status]) }}">Export PDF</a>
            </div>
        </form>

        <div class="mt-6 grid gap-3 lg:grid-cols-2">
            @forelse($submissions as $item)
                <div class="rounded-3xl border p-5 shadow-soft {{ $cardBg[$item->status] ?? 'border-slate-100 bg-white' }}">
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-slate-900">{{ $item->judul }}</div>
                            <div class="mt-1 text-xs text-slate-600">{{ $item->created_at->format('d/m/Y H:i') }} WIB</div>
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
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="text-xs font-semibold text-slate-500">Hasil</div>
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                @if(!is_null($item->similarity_percent))
                                    <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200/60">
                                        Similarity: {{ $item->similarity_percent }}%
                                    </span>
                                @else
                                    <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-600 ring-1 ring-slate-200/60">Similarity: —</span>
                                @endif
                                @if($item->file_doc_url)
                                    <button type="button" data-doc-open="{{ $item->file_doc_url }}" data-doc-title="Dokumen: {{ $item->judul }}" class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-slate-200/60 hover:text-emerald-800">Lihat Dokumen</button>
                                @endif
                                @if($item->report_pdf_url)
                                    <button type="button" data-doc-open="{{ $item->report_pdf_url }}" data-doc-title="Laporan: {{ $item->judul }}" class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-slate-200/60 hover:text-emerald-800">Lihat Laporan</button>
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
                            data-admin-modal-open="turnitin"
                            data-action="{{ route('admin.turnitin.update', $item) }}"
                            data-user="{{ $item->user?->name }}"
                            data-title="{{ $item->judul }}"
                            data-status="{{ $item->status }}"
                            data-similarity="{{ $item->similarity_percent }}"
                            data-catatan="{{ $item->catatan_admin }}"
                            class="w-full rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700"
                        >
                            Update
                        </button>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-600 lg:col-span-2">
                    Belum ada pengajuan Turnitin.
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $submissions->links() }}
        </div>
    </div>

    <div id="turnitinModal" class="fixed inset-0 z-[60] hidden">
        <div data-admin-modal-close="turnitin" class="absolute inset-0 bg-slate-900/40"></div>
        <div class="absolute inset-x-0 top-10 mx-auto w-full max-w-2xl px-4 sm:px-6">
            <div class="rounded-3xl border border-slate-100 bg-white shadow-soft">
                <div class="flex items-start justify-between gap-4 border-b border-slate-100 px-6 py-5">
                    <div class="min-w-0">
                        <div class="text-sm font-semibold text-emerald-700">Update Turnitin</div>
                        <div id="turnitinModalTitle" class="mt-1 truncate text-lg font-semibold text-slate-900"></div>
                        <div id="turnitinModalUser" class="mt-1 truncate text-sm text-slate-600"></div>
                    </div>
                    <button type="button" data-admin-modal-close="turnitin" class="grid h-10 w-10 place-items-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-soft transition hover:bg-slate-50" aria-label="Tutup">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M6 6l12 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>

                <form id="turnitinModalForm" method="POST" enctype="multipart/form-data" class="grid gap-4 px-6 py-6">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="space-y-1 sm:col-span-2">
                            <div class="text-sm font-semibold text-slate-700">Status</div>
                            <select id="turnitin_status" name="status" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                                @foreach($statusOptions as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm font-semibold text-slate-700">Similarity (%)</div>
                            <input id="turnitin_similarity" name="similarity_percent" type="number" min="0" max="100" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="0 - 100">
                        </div>
                        <div class="space-y-1">
                            <div class="text-sm font-semibold text-slate-700">Report (PDF)</div>
                            <input id="turnitin_report" name="report_pdf" type="file" accept="application/pdf" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                        </div>
                        <div class="space-y-1 sm:col-span-2">
                            <div class="text-sm font-semibold text-slate-700">Catatan Admin (opsional)</div>
                            <input id="turnitin_catatan" name="catatan_admin" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Tulis catatan singkat...">
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 pt-2">
                        <button type="submit" class="flex-1 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Simpan</button>
                        <button type="button" data-admin-modal-close="turnitin" class="flex-1 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="turnitinDocModal" class="fixed inset-0 z-[70] hidden">
        <div data-doc-close class="absolute inset-0 bg-slate-900/50"></div>
        <div class="absolute inset-x-0 top-6 mx-auto w-full max-w-5xl px-4 sm:px-6">
            <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-soft">
                <div class="flex items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
                    <div class="min-w-0">
                        <div class="truncate text-sm font-semibold text-emerald-700">Lihat Dokumen</div>
                        <div id="turnitinDocModalTitle" class="truncate text-lg font-semibold text-slate-900"></div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a id="turnitinDocModalOpenNewTab" href="#" target="_blank" rel="noopener" class="hidden rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50 sm:inline-flex">Buka Tab</a>
                        <button type="button" data-doc-close class="grid h-10 w-10 place-items-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-soft transition hover:bg-slate-50" aria-label="Tutup">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M6 6l12 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="bg-slate-50 p-3 sm:p-4">
                    <div class="h-[70vh] overflow-hidden rounded-2xl bg-white ring-1 ring-slate-200/60">
                        <iframe id="turnitinDocModalFrame" title="Dokumen PDF" src="" class="h-full w-full"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const modal = document.getElementById('turnitinModal');
        const form = document.getElementById('turnitinModalForm');
        const title = document.getElementById('turnitinModalTitle');
        const user = document.getElementById('turnitinModalUser');
        const status = document.getElementById('turnitin_status');
        const similarity = document.getElementById('turnitin_similarity');
        const report = document.getElementById('turnitin_report');
        const catatan = document.getElementById('turnitin_catatan');

        const open = (button) => {
            if (!modal || !form) return;
            const action = button.getAttribute('data-action');
            if (action) form.setAttribute('action', action);

            if (title) title.textContent = button.getAttribute('data-title') || '';
            if (user) user.textContent = button.getAttribute('data-user') || '';
            if (status) status.value = button.getAttribute('data-status') || 'submitted';
            if (similarity) similarity.value = button.getAttribute('data-similarity') || '';
            if (catatan) catatan.value = button.getAttribute('data-catatan') || '';
            if (report) report.value = '';

            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        };

        const close = () => {
            if (!modal) return;
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        };

        document.addEventListener('click', (event) => {
            const openBtn = event.target.closest('[data-admin-modal-open="turnitin"]');
            if (openBtn) return open(openBtn);

            const closeBtn = event.target.closest('[data-admin-modal-close="turnitin"]');
            if (closeBtn) return close();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key !== 'Escape') return;
            if (!modal || modal.classList.contains('hidden')) return;
            close();
        });
    })();

    (() => {
        const modal = document.getElementById('turnitinDocModal');
        const frame = document.getElementById('turnitinDocModalFrame');
        const title = document.getElementById('turnitinDocModalTitle');
        const openNewTab = document.getElementById('turnitinDocModalOpenNewTab');

        const open = (url, titleText) => {
            if (!modal || !frame) return;
            if (title) title.textContent = titleText || '';
            if (openNewTab) openNewTab.setAttribute('href', url);
            frame.setAttribute('src', url);
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        };

        const close = () => {
            if (!modal || !frame) return;
            modal.classList.add('hidden');
            frame.setAttribute('src', '');
            document.body.classList.remove('overflow-hidden');
        };

        document.addEventListener('click', (event) => {
            const openBtn = event.target.closest('[data-doc-open]');
            if (openBtn) return open(openBtn.getAttribute('data-doc-open'), openBtn.getAttribute('data-doc-title'));

            const closeBtn = event.target.closest('[data-doc-close]');
            if (closeBtn) return close();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') close();
        });
    })();
</script>
@endpush
