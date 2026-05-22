<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="text-sm text-slate-600">
        Total <span class="font-semibold text-slate-900">{{ $koleksis->total() }}</span> {{ strtolower($jenisLabel ?? 'koleksi') }}
    </div>

    <div class="flex items-center gap-2 text-sm text-slate-600">
        <div>Rows per page:</div>
        <select name="per_page" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
            @foreach([10, 12, 24, 48] as $opt)
                <option value="{{ $opt }}" @selected(((int) ($perPage ?? 10)) === $opt)>{{ $opt }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    @forelse($koleksis as $koleksi)
        <a href="{{ route('koleksi.show', $koleksi) }}" class="group block">
            <div class="rounded-3xl border border-slate-100 bg-white shadow-soft transition hover:-translate-y-1 hover:shadow-lg">
                <div class="relative px-5 pt-8">
                    @php
                        $badgeText = strtoupper(\App\Models\Koleksi::jenisOptions()[$koleksi->jenis] ?? ($jenisLabel ?? 'koleksi'));
                        $badgeClass = match ($koleksi->jenis) {
                            'buku' => 'bg-emerald-600',
                            'e-book' => 'bg-emerald-700',
                            'jurnal' => 'bg-lime-600',
                            'e-jurnal' => 'bg-green-600',
                            'skripsi' => 'bg-amber-500',
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
    @empty
        <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-8 text-sm text-slate-600 lg:col-span-4">
            Tidak ada koleksi yang ditemukan.
        </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $koleksis->links() }}
</div>
