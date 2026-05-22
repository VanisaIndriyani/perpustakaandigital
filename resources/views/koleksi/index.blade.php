@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <section class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3l1.1 3.4a2 2 0 0 0 1.9 1.4H18l-2.8 2a2 2 0 0 0-.7 2.2l1.1 3.4-2.8-2a2 2 0 0 0-2.3 0l-2.8 2 1.1-3.4a2 2 0 0 0-.7-2.2L6 7.8h3a2 2 0 0 0 1.9-1.4L12 3Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-lg font-semibold text-slate-900">Rekomendasi</div>
                        <div class="mt-1 text-sm text-slate-600">Berikut beberapa rekomendasi repository</div>
                    </div>
                </div>

                <div class="hidden items-center gap-2 sm:flex">
                    <button type="button" data-rek-prev class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button type="button" data-rek-next class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mt-6">
                <div id="rekomendasiCarousel" class="overflow-x-auto scroll-smooth snap-x snap-mandatory [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                    <div class="flex gap-4 pr-2">
                        @forelse(($rekomendasi ?? collect()) as $koleksi)
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
                                Belum ada rekomendasi.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mt-5 flex items-center justify-center gap-2" id="rekomendasiDots"></div>

                <div class="mt-4 flex items-center justify-center gap-2 sm:hidden">
                    <button type="button" data-rek-prev class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <button type="button" data-rek-next class="grid h-10 w-10 place-items-center rounded-full border border-emerald-200 bg-white text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                        <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                <div class="flex items-start gap-4">
                    <div class="grid h-12 w-12 place-items-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                        <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4h10a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.44L12 17l-6.26 2.94A.5.5 0 0 1 5 19.5V6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-semibold text-slate-900 sm:text-3xl">Daftar Koleksi {{ $jenisLabel }}</h1>
                        <div class="mt-1 text-sm text-slate-600">Berikut list repository kami. Gunakan pencarian untuk judul, pengarang, atau tahun.</div>
                    </div>
                </div>

                <div class="w-full md:max-w-md">
                    <label class="sr-only" for="koleksiSearch">Search</label>
                    <div class="relative">
                        <span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 19a8 8 0 1 1 0-16 8 8 0 0 1 0 16Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <input id="koleksiSearch" value="{{ $q }}" class="w-full rounded-2xl border border-slate-200 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Search repository by judul or pengarang..." autocomplete="off">
                    </div>
                </div>
            </div>
        </div>

        <div id="koleksiGrid" class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8" data-base-url="{{ url()->current() }}">
            @include('koleksi._grid', ['koleksis' => $koleksis, 'jenisLabel' => $jenisLabel, 'perPage' => $perPage])
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (() => {
            const container = document.getElementById('koleksiGrid');
            const input = document.getElementById('koleksiSearch');
            if (!container || !input) return;

            const baseUrl = container.getAttribute('data-base-url') || window.location.pathname;
            let timer = null;
            let controller = null;

            const buildUrl = (overrides = {}) => {
                const url = new URL(baseUrl, window.location.origin);
                const current = new URL(window.location.href);

                const q = typeof overrides.q !== 'undefined' ? overrides.q : (current.searchParams.get('q') || '');
                const page = typeof overrides.page !== 'undefined' ? overrides.page : (current.searchParams.get('page') || '');
                const perPage = typeof overrides.perPage !== 'undefined' ? overrides.perPage : (current.searchParams.get('per_page') || '');

                if (q && q.trim() !== '') url.searchParams.set('q', q.trim());
                if (page && page !== '') url.searchParams.set('page', page);
                if (perPage && perPage !== '') url.searchParams.set('per_page', perPage);
                url.searchParams.set('partial', '1');

                return url;
            };

            const setHistory = (url) => {
                const publicUrl = new URL(url.toString());
                publicUrl.searchParams.delete('partial');
                window.history.replaceState({}, '', publicUrl);
            };

            const fetchGrid = async (url) => {
                if (controller) controller.abort();
                controller = new AbortController();

                container.classList.add('opacity-70');

                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    signal: controller.signal,
                });

                if (!response.ok) throw new Error('Request failed');

                const html = await response.text();
                container.innerHTML = html;
                container.classList.remove('opacity-70');
                setHistory(url);
            };

            const schedule = (q) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    fetchGrid(buildUrl({ q, page: '' })).catch(() => {
                        container.classList.remove('opacity-70');
                    });
                }, 300);
            };

            input.addEventListener('input', (e) => schedule(e.target.value || ''));

            container.addEventListener('change', (e) => {
                const select = e.target.closest('select[name="per_page"]');
                if (!select) return;
                fetchGrid(buildUrl({ q: input.value || '', page: '', perPage: select.value || '' })).catch(() => {
                    container.classList.remove('opacity-70');
                });
            });

            container.addEventListener('click', (e) => {
                const link = e.target.closest('a');
                if (!link) return;

                const href = link.getAttribute('href');
                if (!href) return;

                const url = new URL(href, window.location.origin);
                const isPagination = url.searchParams.has('page');
                if (!isPagination) return;

                e.preventDefault();
                const q = input.value || '';
                url.searchParams.set('partial', '1');
                if (q && q.trim() !== '') url.searchParams.set('q', q.trim());
                fetchGrid(url).catch(() => {
                    container.classList.remove('opacity-70');
                });
            });
        })();
    </script>

    <script>
        (() => {
            const scroller = document.getElementById('rekomendasiCarousel');
            const dots = document.getElementById('rekomendasiDots');
            if (!scroller || !dots) return;

            const prevButtons = Array.from(document.querySelectorAll('[data-rek-prev]'));
            const nextButtons = Array.from(document.querySelectorAll('[data-rek-next]'));

            const getStep = () => Math.max(1, scroller.clientWidth);
            const getPageCount = () => Math.max(1, Math.round(scroller.scrollWidth / getStep()));
            const getIndex = () => Math.round(scroller.scrollLeft / getStep());

            const renderDots = () => {
                const count = getPageCount();
                dots.innerHTML = '';
                for (let i = 0; i < count; i++) {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.setAttribute('data-dot', String(i));
                    btn.className = 'h-2.5 w-2.5 rounded-full bg-slate-300 transition';
                    btn.addEventListener('click', () => {
                        scroller.scrollTo({ left: i * getStep(), behavior: 'smooth' });
                    });
                    dots.appendChild(btn);
                }
                updateDots();
            };

            const updateDots = () => {
                const index = getIndex();
                dots.querySelectorAll('button[data-dot]').forEach((btn) => {
                    const isActive = Number(btn.getAttribute('data-dot')) === index;
                    btn.classList.toggle('bg-emerald-600', isActive);
                    btn.classList.toggle('bg-slate-300', !isActive);
                    btn.classList.toggle('w-6', isActive);
                    btn.classList.toggle('w-2.5', !isActive);
                });
            };

            prevButtons.forEach((btn) => {
                btn.addEventListener('click', () => scroller.scrollBy({ left: -getStep(), behavior: 'smooth' }));
            });
            nextButtons.forEach((btn) => {
                btn.addEventListener('click', () => scroller.scrollBy({ left: getStep(), behavior: 'smooth' }));
            });

            let resizeTimer = null;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    renderDots();
                }, 120);
            });

            scroller.addEventListener('scroll', () => {
                window.requestAnimationFrame(updateDots);
            });

            renderDots();
        })();
    </script>
@endpush
