@extends('layouts.app')

@section('content')
    @php
        $backRoute = match ($koleksi->jenis) {
            'jurnal' => 'koleksi.jurnal',
            'e-jurnal' => 'koleksi.ejurnal',
            'buku' => 'koleksi.buku',
            'e-book' => 'koleksi.ebook',
            'skripsi' => 'koleksi.skripsi',
            'ppl-kk' => 'koleksi.pplkk',
            default => 'home',
        };
        $jenisLabel = \Illuminate\Support\Arr::get(\App\Models\Koleksi::jenisOptions(), $koleksi->jenis, ucfirst($koleksi->jenis));
    @endphp

    <div class="space-y-6">
        @if(session('status'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif
        @if($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route($backRoute) }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">
                <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali
            </a>
            <div class="flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200/60">{{ $jenisLabel }}</span>
                @if($koleksi->kategori)
                    <span class="rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60">{{ $koleksi->kategori->nama_kategori }}</span>
                @endif
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-soft">
                <div class="relative aspect-[3/4] bg-gradient-to-br from-emerald-50 to-slate-50">
                    @if($koleksi->cover_url)
                        <img src="{{ $koleksi->cover_url }}" alt="{{ $koleksi->judul }}" class="h-full w-full object-cover">
                    @else
                        <div class="absolute inset-0 grid place-items-center text-emerald-700/70">
                            <svg viewBox="0 0 24 24" fill="none" class="h-10 w-10" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
                    <h1 class="text-2xl font-semibold text-slate-900 sm:text-3xl">{{ $koleksi->judul }}</h1>
                    <div class="mt-3 flex flex-wrap gap-2 text-sm text-slate-600">
                        <div class="rounded-xl bg-slate-50 px-3 py-2 ring-1 ring-slate-200/60">
                            <span class="font-semibold text-slate-800">Pengarang:</span> {{ $koleksi->pengarang }}
                        </div>
                        <div class="rounded-xl bg-slate-50 px-3 py-2 ring-1 ring-slate-200/60">
                            <span class="font-semibold text-slate-800">Tahun:</span> {{ $koleksi->tahun ?? '—' }}
                        </div>
                    </div>

                    @if($koleksi->deskripsi)
                        <div class="mt-6 space-y-2">
                            <div class="text-sm font-semibold text-slate-900">Deskripsi</div>
                            <div class="text-sm leading-relaxed text-slate-700">
                                {!! nl2br(e($koleksi->deskripsi)) !!}
                            </div>
                        </div>
                    @endif

                    <div class="mt-8 flex flex-wrap gap-3">
                        @if($koleksi->file_pdf_url)
                            <button type="button" data-doc-open="{{ $koleksi->file_pdf_url }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-8-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 15h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                                Lihat Dokumen
                            </button>
                            <a href="{{ $koleksi->file_pdf_url }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 3v10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M8 10l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5 17v3h14v-3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Download PDF
                            </a>
                        @endif
                        <a href="{{ route($backRoute) }}" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 6h13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M3 6h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                                <path d="M8 12h13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M3 12h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                                <path d="M8 18h13" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M3 18h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                            </svg>
                            Lihat Semua
                        </a>
                        @php($canBorrow = in_array($koleksi->jenis, ['buku', 'skripsi', 'ppl-kk'], true))
                        @if($canBorrow)
                            @auth
                                @if(auth()->user()->role === 'mahasiswa')
                                    <form method="POST" action="{{ route('mahasiswa.peminjaman.store') }}">
                                        @csrf
                                        <input type="hidden" name="koleksi_id" value="{{ $koleksi->id }}">
                                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 8h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                                <path d="M9 12h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                            </svg>
                                            Ajukan Peminjaman
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-2xl border border-emerald-200 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                                    Login untuk Peminjaman
                                </a>
                            @endguest
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($koleksi->file_pdf_url)
        <div id="docModal" class="fixed inset-0 z-[60] hidden">
            <div data-doc-close class="absolute inset-0 bg-slate-900/50"></div>
            <div class="absolute inset-x-0 top-6 mx-auto w-full max-w-5xl px-4 sm:px-6">
                <div class="overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-soft">
                    <div class="flex items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
                        <div class="min-w-0">
                            <div class="truncate text-sm font-semibold text-emerald-700">Dokumen</div>
                            <div class="truncate text-lg font-semibold text-slate-900">{{ $koleksi->judul }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a id="docModalOpenNewTab" href="{{ $koleksi->file_pdf_url }}" target="_blank" rel="noopener" class="hidden rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50 sm:inline-flex">Buka Tab</a>
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
                            <iframe id="docModalFrame" title="Dokumen PDF" src="{{ $koleksi->file_pdf_url }}" class="h-full w-full"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@if($koleksi->file_pdf_url)
@push('scripts')
<script>
    (() => {
        const modal = document.getElementById('docModal');
        const frame = document.getElementById('docModalFrame');

        const open = (url) => {
            if (!modal || !frame) return;
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
            if (openBtn) return open(openBtn.getAttribute('data-doc-open'));

            const closeBtn = event.target.closest('[data-doc-close]');
            if (closeBtn) return close();
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') close();
        });
    })();
</script>
@endpush
@endif
