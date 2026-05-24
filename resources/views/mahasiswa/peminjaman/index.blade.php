@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="text-sm font-semibold text-emerald-700">Mahasiswa</div>
                    <div class="text-2xl font-semibold text-slate-900">Peminjaman</div>
                    <div class="mt-2 text-sm text-slate-600">Ajukan peminjaman dari halaman detail koleksi.</div>
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
            </div>
        </div>

        @if(session('status'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="grid gap-3 lg:grid-cols-2">
                @forelse($peminjamans as $item)
                    <div class="rounded-3xl border border-slate-100 bg-white p-5 shadow-soft">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="truncate text-sm font-semibold text-slate-900">{{ $item->koleksi?->judul }}</div>
                                <div class="mt-1 truncate text-xs text-slate-600">{{ $item->koleksi?->pengarang }}</div>
                            </div>
                            <span class="shrink-0 rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60">
                                {{ $statusOptions[$item->status] ?? $item->status }}
                            </span>
                        </div>

                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-600 ring-1 ring-slate-200/60">
                                <div class="text-xs font-semibold text-slate-500">Tanggal</div>
                                <div class="mt-1 space-y-1">
                                    <div>Diajukan: {{ $item->created_at->format('d/m/Y H:i') }} WIB</div>
                                    <div>Pinjam: {{ $item->tanggal_pinjam ? $item->tanggal_pinjam->format('d/m/Y') : '—' }}</div>
                                    <div>Batas waktu: {{ $item->tanggal_jatuh_tempo ? $item->tanggal_jatuh_tempo->format('d/m/Y') : '—' }}</div>
                                    @if($item->tanggal_kembali)
                                        <div>Kembali: {{ $item->tanggal_kembali->format('d/m/Y') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-600 ring-1 ring-slate-200/60">
                                <div class="text-xs font-semibold text-slate-500">Bukti</div>
                                <div class="mt-2">
                                    @if(in_array($item->status, ['approved', 'borrowed', 'returned'], true))
                                        <a class="inline-flex w-full items-center justify-center rounded-2xl border border-emerald-200 bg-white px-4 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50" href="{{ route('mahasiswa.peminjaman.bukti.pdf', $item) }}">
                                            Cetak PDF
                                        </a>
                                    @else
                                        <div class="text-xs font-semibold text-slate-400">Tersedia setelah disetujui.</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($item->catatan_admin || $item->catatan_user)
                            <div class="mt-3 rounded-2xl bg-slate-50 px-4 py-3 text-xs text-slate-700 ring-1 ring-slate-200/60">
                                <div class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Catatan</div>
                                @if($item->catatan_admin)
                                    <div class="mt-1"><span class="font-semibold text-slate-800">Admin:</span> {{ $item->catatan_admin }}</div>
                                @endif
                                @if($item->catatan_user)
                                    <div class="mt-1"><span class="font-semibold text-slate-800">Saya:</span> {{ $item->catatan_user }}</div>
                                @endif
                            </div>
                        @endif
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
    </div>
@endsection
