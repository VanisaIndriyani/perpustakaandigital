@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden rounded-3xl border border-emerald-100 bg-gradient-to-br from-emerald-600 via-emerald-600 to-emerald-700 px-6 py-12 text-white shadow-soft sm:px-10">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-white/30 blur-3xl"></div>
            <div class="absolute -right-24 -bottom-24 h-64 w-64 rounded-full bg-white/20 blur-3xl"></div>
        </div>
      
        <div class="relative grid gap-8 md:grid-cols-2 md:items-center">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 ring-1 ring-white/20">
                    <span class="grid h-5 w-5 place-items-center overflow-hidden rounded-full bg-white/80">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-5 w-5 object-contain p-0.5">
                    </span>
                   Repository IAI DDI Sidenreng Rappang
                </div>
                <h1 class="text-3xl font-semibold leading-tight sm:text-4xl">
                    Repository IAI DDI Sidenreng Rappang Modern dan Profesional
                    <!-- <span class="block text-white/90">modern dan profesional</span> -->
                </h1>
                <p class="max-w-prose text-white/90">
                   Welcome to Repository IAI DDI Sidenreng Rappang, Jelajahi Jurnal, E-Jurnal, Buku, E-Book, Skripsi dan Laporan PPL dengan tampilan yang modern dan profesional
                </p>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('koleksi.jurnal') }}" class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">Lihat Jurnal Kampus</a>
                    <a href="{{ route('koleksi.buku') }}" class="rounded-xl bg-emerald-500/30 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/30 transition hover:bg-emerald-500/40">Lihat Buku</a>
                </div>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                @foreach($jenisOptions as $jenisKey => $jenisLabel)
                    @php
                        $routeName = match ($jenisKey) {
                            'jurnal' => 'koleksi.jurnal',
                            'e-jurnal' => 'koleksi.ejurnal',
                            'buku' => 'koleksi.buku',
                            'e-book' => 'koleksi.ebook',
                            'skripsi' => 'koleksi.skripsi',
                            'ppl-kk' => 'koleksi.pplkk',
                            default => 'home',
                        };
                    @endphp
                    <a href="{{ route($routeName) }}" class="group flex items-center justify-between rounded-2xl bg-white/10 px-4 py-4 ring-1 ring-white/20 transition hover:bg-white/15">
                        <div>
                            <div class="text-sm font-semibold">{{ $jenisLabel }}</div>
                            <div class="text-xs text-white/75">{{ $latestByJenis[$jenisKey]->count() }} koleksi terbaru</div>
                        </div>
                        <div class="grid h-9 w-9 place-items-center rounded-xl bg-white/10 ring-1 ring-white/20 transition group-hover:bg-white/15">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="mt-10 space-y-10">
        @foreach($jenisOptions as $jenisKey => $jenisLabel)
            @php
                $routeName = match ($jenisKey) {
                    'jurnal' => 'koleksi.jurnal',
                    'e-jurnal' => 'koleksi.ejurnal',
                    'buku' => 'koleksi.buku',
                    'e-book' => 'koleksi.ebook',
                    'skripsi' => 'koleksi.skripsi',
                    'ppl-kk' => 'koleksi.pplkk',
                    default => 'home',
                };
            @endphp
            <section class="space-y-4" data-generic-carousel>
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">{{ $jenisLabel }}</h2>
                        <div class="text-sm text-slate-600">Koleksi terbaru untuk kategori {{ strtolower($jenisLabel) }}.</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="hidden items-center gap-2 sm:flex">
                            <button type="button" data-carousel-prev class="grid h-8 w-8 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                                <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button type="button" data-carousel-next class="grid h-8 w-8 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                                <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <a href="{{ route($routeName) }}" class="inline-flex items-center gap-2 rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                            Lihat semua
                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div data-carousel-scroller class="overflow-x-auto scroll-smooth snap-x snap-mandatory [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                        <div class="flex gap-6 pb-4">
                            @forelse($latestByJenis[$jenisKey] as $koleksi)
                                <div class="w-full shrink-0 snap-start sm:w-[calc(50%-0.75rem)] lg:w-[calc(25%-1.125rem)]">
                                    <a href="{{ route('koleksi.show', $koleksi) }}" class="group block">
                                        <div class="rounded-3xl border border-slate-100 bg-white shadow-soft transition hover:-translate-y-1 hover:shadow-lg">
                                            <div class="relative px-5 pt-8">
                                                @php
                                                    $badgeText = strtoupper(\App\Models\Koleksi::jenisOptions()[$koleksi->jenis] ?? $jenisLabel);
                                                    $badgeClass = match ($koleksi->jenis) {
                                                        'buku' => 'bg-emerald-600',
                                                        'e-book' => 'bg-emerald-700',
                                                        'jurnal' => 'bg-lime-600',
                                                        'e-jurnal' => 'bg-green-600',
                                                        'skripsi' => 'bg-amber-500',
                                                        'ppl-kk' => 'bg-emerald-500',
                                                        default => 'bg-emerald-600',
                                                    };
                                                @endphp
                                                <div class="absolute right-4 top-4 rounded-full {{ $badgeClass }} px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white shadow-soft">
                                                    {{ $badgeText }}
                                                </div>

                                                <div class="-mt-12 mx-auto aspect-[3/4] w-full max-w-[220px] overflow-hidden rounded-2xl bg-slate-200 shadow-soft ring-1 ring-slate-200">
                                                    @if($koleksi->cover_url)
                                                        <img src="{{ $koleksi->cover_url }}" alt="{{ $koleksi->judul }}" class="h-full w-full object-cover">
                                                    @else
                                                        <div class="flex h-full w-full flex-col items-center justify-center gap-3 bg-slate-500 text-white">
                                                            <div class="text-center text-xl font-extrabold leading-none tracking-wide">IMAGE<br>NOT<br>AVAILABLE</div>
                                                            <svg viewBox="0 0 24 24" fill="none" class="h-10 w-10 opacity-90" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mt-4 rounded-b-3xl bg-emerald-50/70 px-5 pb-5 pt-4">
                                                <div class="text-xs text-slate-600">{{ $koleksi->pengarang }}</div>
                                                <div class="mt-1 max-h-10 overflow-hidden text-sm font-semibold leading-5 text-slate-900 group-hover:text-emerald-700">{{ $koleksi->judul }}</div>
                                                <div class="mt-4 flex items-center justify-between gap-3">
                                                    <div class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/70">{{ $koleksi->tahun ?? '—' }}</div>
                                                    <span class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-soft transition group-hover:bg-emerald-700">Detail</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="w-full rounded-3xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-600">
                                    Belum ada koleksi untuk {{ strtolower($jenisLabel) }}.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="mt-2 flex items-center justify-center gap-2" data-carousel-dots></div>

                    <div class="mt-4 flex items-center justify-center gap-2 sm:hidden">
                        <button type="button" data-carousel-prev class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button type="button" data-carousel-next class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        @endforeach
    </div>

    <section class="mt-12 rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8" data-home-collection>
        @php
            $tabOrder = ['jurnal', 'e-jurnal', 'buku', 'e-book', 'skripsi', 'ppl-kk'];
        @endphp

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-start gap-4">
                <div class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-semibold text-slate-900">Koleksi Perpustakaan</div>
                    <div class="mt-1 text-sm text-slate-600">Berikut beberapa rekomendasi repository</div>
                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        @foreach($tabOrder as $jenisKey)
                            @php
                                $jenisLabel = $jenisOptions[$jenisKey] ?? ucfirst($jenisKey);
                            @endphp
                            <button type="button" data-home-tab="{{ $jenisKey }}" class="rounded-full bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-soft ring-1 ring-slate-200/60 transition hover:bg-slate-50">
                                {{ strtoupper($jenisLabel) }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="hidden items-center gap-2 sm:flex">
                <button type="button" data-home-prev class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button type="button" data-home-next class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="mt-6">
            @foreach($tabOrder as $jenisKey)
                @php
                    $jenisLabel = $jenisOptions[$jenisKey] ?? ucfirst($jenisKey);
                    $routeName = match ($jenisKey) {
                        'jurnal' => 'koleksi.jurnal',
                        'e-jurnal' => 'koleksi.ejurnal',
                        'buku' => 'koleksi.buku',
                        'e-book' => 'koleksi.ebook',
                        'skripsi' => 'koleksi.skripsi',
                        'ppl-kk' => 'koleksi.pplkk',
                        default => 'home',
                    };
                @endphp
                <div data-home-panel="{{ $jenisKey }}" class="{{ $jenisKey === 'jurnal' ? '' : 'hidden' }}">
                    <div class="flex items-center justify-between gap-3">
                        <div class="text-sm font-semibold text-slate-900">{{ $jenisLabel }}</div>
                        <a href="{{ route($routeName) }}" class="rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">Lihat semua</a>
                    </div>

                    <div class="mt-4">
                        <div data-home-carousel class="overflow-x-auto scroll-smooth snap-x snap-mandatory [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                            <div class="flex gap-4 pr-2">
                                @forelse($latestByJenis[$jenisKey] as $koleksi)
                                    <div class="w-full shrink-0 snap-start sm:w-[calc(50%-0.5rem)] lg:w-[calc(25%-0.75rem)]">
                                        <a href="{{ route('koleksi.show', $koleksi) }}" class="group block">
                                            <div class="rounded-3xl border border-slate-100 bg-white shadow-soft transition hover:-translate-y-1 hover:shadow-lg">
                                                <div class="relative px-5 pt-8">
                                                    @php
                                                        $badgeText = strtoupper(\App\Models\Koleksi::jenisOptions()[$koleksi->jenis] ?? $jenisLabel);
                                                        $badgeClass = match ($koleksi->jenis) {
                                                            'buku' => 'bg-emerald-600',
                                                            'e-book' => 'bg-emerald-700',
                                                            'jurnal' => 'bg-lime-600',
                                                            'e-jurnal' => 'bg-green-600',
                                                            'skripsi' => 'bg-amber-500',
                                                            'ppl-kk' => 'bg-emerald-500',
                                                            default => 'bg-emerald-600',
                                                        };
                                                    @endphp
                                                    <div class="absolute right-4 top-4 rounded-full {{ $badgeClass }} px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white shadow-soft">
                                                        {{ $badgeText }}
                                                    </div>

                                                    <div class="-mt-12 mx-auto aspect-[3/4] w-full max-w-[220px] overflow-hidden rounded-2xl bg-slate-200 shadow-soft ring-1 ring-slate-200">
                                                        @if($koleksi->cover_url)
                                                            <img src="{{ $koleksi->cover_url }}" alt="{{ $koleksi->judul }}" class="h-full w-full object-cover">
                                                        @else
                                                            <div class="flex h-full w-full flex-col items-center justify-center gap-3 bg-slate-500 text-white">
                                                                <div class="text-center text-xl font-extrabold leading-none tracking-wide">IMAGE<br>NOT<br>AVAILABLE</div>
                                                                <svg viewBox="0 0 24 24" fill="none" class="h-10 w-10 opacity-90" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mt-4 rounded-b-3xl bg-emerald-50/70 px-5 pb-5 pt-4">
                                                    <div class="text-xs text-slate-600">{{ $koleksi->pengarang }}</div>
                                                    <div class="mt-1 max-h-10 overflow-hidden text-sm font-semibold leading-5 text-slate-900 group-hover:text-emerald-700">{{ $koleksi->judul }}</div>
                                                    <div class="mt-4 flex items-center justify-between gap-3">
                                                        <div class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/70">{{ $koleksi->tahun ?? '—' }}</div>
                                                        <span class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-soft transition group-hover:bg-emerald-700">Detail</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <div class="w-full rounded-3xl border border-dashed border-slate-200 bg-slate-50 p-8 text-sm text-slate-600">
                                        Belum ada koleksi untuk {{ strtolower($jenisLabel) }}.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-5 flex items-center justify-center gap-2" data-home-dots></div>

                        <div class="mt-4 flex items-center justify-center gap-2 sm:hidden">
                            <button type="button" data-home-prev class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button type="button" data-home-next class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (() => {
            // 1. Initialize Generic Carousels (Category sections)
            // Handled globally in layouts/app.blade.php via [data-generic-carousel]

            // 2. Initialize Tabbed Carousel (Bottom section)
            const homeCollection = document.querySelector('[data-home-collection]');
            if (homeCollection) {
                const tabButtons = Array.from(homeCollection.querySelectorAll('[data-home-tab]'));
                const panels = Array.from(homeCollection.querySelectorAll('[data-home-panel]'));
                const sharedPrev = homeCollection.querySelectorAll(':scope > div [data-home-prev]');
                const sharedNext = homeCollection.querySelectorAll(':scope > div [data-home-next]');

                let currentCarousel = null;

                const setActiveTab = (key) => {
                    if (currentCarousel) {
                        currentCarousel.destroy();
                        currentCarousel = null;
                    }

                    panels.forEach(p => p.classList.toggle('hidden', p.dataset.homePanel !== key));
                    tabButtons.forEach(btn => {
                        const isActive = btn.dataset.homeTab === key;
                        btn.classList.toggle('bg-emerald-600', isActive);
                        btn.classList.toggle('text-white', isActive);
                        btn.classList.toggle('ring-emerald-600', isActive);
                        btn.classList.toggle('bg-white', !isActive);
                        btn.classList.toggle('text-slate-700', !isActive);
                        btn.classList.toggle('ring-slate-200/60', !isActive);
                    });

                    const panel = panels.find(p => p.dataset.homePanel === key);
                    if (panel && window.initCarousel) {
                        currentCarousel = window.initCarousel(panel, {
                            scroller: '[data-home-carousel]',
                            dots: '[data-home-dots]',
                            prev: '[data-home-prev]',
                            next: '[data-home-next]',
                            externalPrev: sharedPrev,
                            externalNext: sharedNext
                        });
                        if (currentCarousel) {
                            currentCarousel.scroller.scrollTo({ left: 0, behavior: 'auto' });
                        }
                    }
                };

                tabButtons.forEach(btn => btn.addEventListener('click', () => setActiveTab(btn.dataset.homeTab)));
                const defaultBtn = tabButtons.find(btn => btn.dataset.homeTab === 'jurnal') || tabButtons[0];
                if (defaultBtn) setActiveTab(defaultBtn.dataset.homeTab);
            }
        })();
    </script>
@endpush
