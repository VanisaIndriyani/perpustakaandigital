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
@endsection
