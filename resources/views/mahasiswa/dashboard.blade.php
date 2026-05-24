@extends('layouts.app')

@section('content')
    @php
        $peminjamanBadge = [
            'requested' => 'bg-amber-50 text-amber-800 ring-amber-200/70',
            'approved' => 'bg-sky-50 text-sky-800 ring-sky-200/70',
            'rejected' => 'bg-rose-50 text-rose-700 ring-rose-200/70',
            'borrowed' => 'bg-indigo-50 text-indigo-800 ring-indigo-200/70',
            'returned' => 'bg-emerald-50 text-emerald-800 ring-emerald-200/70',
        ];
        $turnitinBadge = [
            'submitted' => 'bg-amber-50 text-amber-800 ring-amber-200/70',
            'checking' => 'bg-sky-50 text-sky-800 ring-sky-200/70',
            'completed' => 'bg-emerald-50 text-emerald-800 ring-emerald-200/70',
        ];
    @endphp

    <div class="space-y-6">
        <div class="grid gap-4 lg:grid-cols-3">
            <div class="relative overflow-hidden rounded-3xl border border-emerald-100/70 bg-gradient-to-br from-emerald-600 via-emerald-600 to-emerald-700 p-6 text-white shadow-soft sm:p-8 lg:col-span-2">
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
                <div class="absolute -bottom-24 -left-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative grid gap-6 md:grid-cols-2 md:items-center">
                    <div class="space-y-4">
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 ring-1 ring-white/20">
                            Akun Mahasiswa
                        </div>
                        <div class="space-y-1">
                            <div class="text-2xl font-semibold leading-tight">{{ $user?->name }}</div>
                            <div class="text-sm text-white/90">{{ $user?->email }}</div>
                        </div>

                        <div class="grid gap-2 text-sm text-white/90 sm:grid-cols-2">
                            <div class="rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15">
                                <div class="text-xs font-semibold text-white/80">NIM</div>
                                <div class="mt-0.5 font-semibold">{{ $user?->nim ?? '-' }}</div>
                            </div>
                            <div class="rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15">
                                <div class="text-xs font-semibold text-white/80">No. HP</div>
                                <div class="mt-0.5 font-semibold">{{ $user?->phone ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-2">
                        <a href="{{ route('mahasiswa.peminjaman.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 19.5V6.5A2.5 2.5 0 0 1 6.5 4H18a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.5.5H6.5A2.5 2.5 0 0 1 4 19.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.5 4H18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                            Peminjaman
                        </a>
                        <div class="grid gap-2 sm:grid-cols-2">
                            <a href="{{ route('mahasiswa.turnitin.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500/30 px-5 py-3 text-sm font-semibold text-white ring-1 ring-white/25 transition hover:bg-emerald-500/40">
                                <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Turnitin
                            </a>
                            <a href="{{ route('mahasiswa.turnitin.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/10 px-5 py-3 text-sm font-semibold text-white ring-1 ring-white/20 transition hover:bg-white/15">
                                <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5v14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M5 12h14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                </svg>
                                Ajukan
                            </a>
                        </div>
                        <a href="{{ route('koleksi.buku') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/10 px-5 py-3 text-sm font-semibold text-white ring-1 ring-white/20 transition hover:bg-white/15">
                            <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 12h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                <path d="M15 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Jelajahi Koleksi
                        </a>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-sm font-semibold text-slate-900">Ringkasan</div>
                        <div class="mt-1 text-sm text-slate-600">Status peminjaman dan Turnitin.</div>
                    </div>
                </div>

                <div class="mt-6 grid gap-3">
                    <div class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                        <div class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                            <span class="grid h-9 w-9 place-items-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 19.5V6.5A2.5 2.5 0 0 1 6.5 4H18a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.5.5H6.5A2.5 2.5 0 0 1 4 19.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            Total Peminjaman
                        </div>
                        <div class="text-lg font-semibold text-slate-900">{{ $peminjamanCounts['total'] ?? 0 }}</div>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2">
                        <div class="rounded-2xl bg-amber-50 px-4 py-3 ring-1 ring-amber-200/70">
                            <div class="text-xs font-semibold text-amber-800">Menunggu</div>
                            <div class="mt-1 text-xl font-semibold text-slate-900">{{ $peminjamanCounts['requested'] ?? 0 }}</div>
                        </div>
                        <div class="rounded-2xl bg-indigo-50 px-4 py-3 ring-1 ring-indigo-200/70">
                            <div class="text-xs font-semibold text-indigo-800">Dipinjam</div>
                            <div class="mt-1 text-xl font-semibold text-slate-900">{{ $peminjamanCounts['borrowed'] ?? 0 }}</div>
                        </div>
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="text-xs font-semibold text-slate-700">Dikembalikan</div>
                            <div class="mt-1 text-xl font-semibold text-slate-900">{{ $peminjamanCounts['returned'] ?? 0 }}</div>
                        </div>
                        <div class="rounded-2xl bg-emerald-50 px-4 py-3 ring-1 ring-emerald-200/60">
                            <div class="text-xs font-semibold text-emerald-800">Turnitin Selesai</div>
                            <div class="mt-1 text-xl font-semibold text-slate-900">{{ $turnitinCounts['completed'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-4 lg:grid-cols-2">
            <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-sm font-semibold text-slate-900">Peminjaman Terbaru</div>
                        <div class="mt-1 text-sm text-slate-600">Riwayat pengajuan peminjaman.</div>
                    </div>
                    <a href="{{ route('mahasiswa.peminjaman.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Lihat</a>
                </div>

                <div class="mt-5 space-y-3">
                    @forelse($peminjamans as $item)
                        <div class="flex items-start justify-between gap-3 rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="min-w-0">
                                <div class="truncate text-sm font-semibold text-slate-900">{{ $item->koleksi?->judul }}</div>
                                <div class="mt-1 text-xs text-slate-600">{{ $item->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                            <span class="shrink-0 rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $peminjamanBadge[$item->status] ?? 'bg-white text-slate-700 ring-slate-200/60' }}">
                                {{ \App\Models\Peminjaman::statusOptions()[$item->status] ?? $item->status }}
                            </span>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6">
                            <div class="flex items-start gap-3">
                                <span class="grid h-10 w-10 place-items-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21s7-4.4 7-11a7 7 0 1 0-14 0c0 6.6 7 11 7 11Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 10.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div class="space-y-1">
                                    <div class="text-sm font-semibold text-slate-900">Belum ada peminjaman</div>
                                    <div class="text-sm text-slate-600">Buka detail koleksi (Buku/Skripsi/PPL) lalu ajukan peminjaman.</div>
                                    <div class="pt-2">
                                        <a href="{{ route('koleksi.buku') }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Cari Buku</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <div class="text-sm font-semibold text-slate-900">Turnitin Terbaru</div>
                        <div class="mt-1 text-sm text-slate-600">Riwayat pengajuan Turnitin.</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('mahasiswa.turnitin.create') }}" class="rounded-xl bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Ajukan</a>
                        <a href="{{ route('mahasiswa.turnitin.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Lihat</a>
                    </div>
                </div>

                <div class="mt-5 space-y-3">
                    @forelse($turnitinSubmissions as $item)
                        <div class="flex items-start justify-between gap-3 rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="min-w-0">
                                <div class="truncate text-sm font-semibold text-slate-900">{{ $item->judul }}</div>
                                <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-slate-600">
                                    <span class="rounded-full px-3 py-1 font-semibold ring-1 {{ $turnitinBadge[$item->status] ?? 'bg-white text-slate-700 ring-slate-200/60' }}">
                                        {{ \App\Models\TurnitinSubmission::statusOptions()[$item->status] ?? $item->status }}
                                    </span>
                                    @if(!is_null($item->similarity_percent))
                                        <span class="rounded-full bg-white px-3 py-1 font-semibold text-emerald-700 ring-1 ring-emerald-200/60">{{ $item->similarity_percent }}%</span>
                                    @endif
                                    <span>{{ $item->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                            <span class="grid h-9 w-9 place-items-center rounded-2xl bg-white text-slate-700 ring-1 ring-slate-200/60">
                                <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6">
                            <div class="flex items-start gap-3">
                                <span class="grid h-10 w-10 place-items-center rounded-2xl bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/60">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div class="space-y-1">
                                    <div class="text-sm font-semibold text-slate-900">Belum ada pengajuan Turnitin</div>
                                    <div class="text-sm text-slate-600">Klik tombol Ajukan untuk upload dokumen (pdf/doc/docx).</div>
                                    <div class="pt-2">
                                        <a href="{{ route('mahasiswa.turnitin.create') }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Ajukan Turnitin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
