@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="text-sm font-semibold text-emerald-700">Mahasiswa</div>
                    <div class="text-2xl font-semibold text-slate-900">Turnitin</div>
                    <div class="mt-2 text-sm text-slate-600">Ajukan pengecekan dokumen dan pantau statusnya.</div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('mahasiswa.turnitin.create') }}" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Ajukan</a>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
                </div>
            </div>
        </div>

        @if(session('status'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="py-3 pr-4">Judul</th>
                        <th class="py-3 pr-4">Status</th>
                        <th class="py-3 pr-4">Similarity</th>
                        <th class="py-3 pr-4">File</th>
                        <th class="py-3 pr-4">Laporan</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                    @foreach($submissions as $item)
                        <tr>
                            <td class="py-4 pr-4">
                                <div class="font-semibold text-slate-900">{{ $item->judul }}</div>
                                <div class="mt-1 text-xs text-slate-600">{{ $item->created_at->format('d/m/Y H:i') }} WIB</div>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60">
                                    {{ $statusOptions[$item->status] ?? $item->status }}
                                </span>
                            </td>
                            <td class="py-4 pr-4">
                                @if(!is_null($item->similarity_percent))
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200/60">
                                        {{ $item->similarity_percent }}%
                                    </span>
                                @else
                                    <span class="text-xs text-slate-500">—</span>
                                @endif
                            </td>
                            <td class="py-4 pr-4">
                                @if($item->file_doc_url)
                                    <div class="flex flex-wrap items-center gap-2">
                                        <button type="button" data-doc-open="{{ $item->file_doc_url }}" data-doc-title="Dokumen: {{ $item->judul }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">Lihat</button>
                                        <a class="text-sm font-semibold text-slate-600 hover:text-slate-800" href="{{ $item->file_doc_url }}" target="_blank" rel="noopener">Unduh</a>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-500">—</span>
                                @endif
                            </td>
                            <td class="py-4 pr-4">
                                @if($item->report_pdf_url)
                                    <div class="flex flex-wrap items-center gap-2">
                                        <button type="button" data-doc-open="{{ $item->report_pdf_url }}" data-doc-title="Laporan: {{ $item->judul }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">Lihat</button>
                                        <a class="text-sm font-semibold text-slate-600 hover:text-slate-800" href="{{ $item->report_pdf_url }}" target="_blank" rel="noopener">Unduh</a>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-500">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $submissions->links() }}
            </div>
        </div>
    </div>

    <div id="docModal" class="fixed inset-0 z-[60] hidden">
        <div data-doc-close class="absolute inset-0 bg-slate-900/50"></div>
        <div class="absolute inset-x-0 top-6 mx-auto w-full max-w-5xl px-4 sm:px-6">
            <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-soft">
                <div class="flex items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
                    <div class="min-w-0">
                        <div class="truncate text-sm font-semibold text-emerald-700">Lihat Dokumen</div>
                        <div id="docModalTitle" class="truncate text-lg font-semibold text-slate-900"></div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a id="docModalOpenNewTab" href="#" target="_blank" rel="noopener" class="hidden rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50 sm:inline-flex">Buka Tab</a>
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
                        <iframe id="docModalFrame" title="Dokumen PDF" src="" class="h-full w-full"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (() => {
        const modal = document.getElementById('docModal');
        const frame = document.getElementById('docModalFrame');
        const title = document.getElementById('docModalTitle');
        const openNewTab = document.getElementById('docModalOpenNewTab');

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
