@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="text-sm font-semibold text-emerald-700">Akun</div>
                    <div class="text-2xl font-semibold text-slate-900">Dashboard Mahasiswa</div>
                    <div class="mt-2 text-sm text-slate-600">Kelola peminjaman dan pengajuan Turnitin.</div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('mahasiswa.peminjaman.index') }}" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Peminjaman</a>
                    <a href="{{ route('mahasiswa.turnitin.index') }}" class="rounded-2xl border border-emerald-200 bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">Turnitin</a>
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
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="text-sm font-semibold text-slate-900">{{ $item->koleksi?->judul }}</div>
                            <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-slate-600">
                                <span class="rounded-full bg-white px-3 py-1 font-semibold ring-1 ring-slate-200/60">{{ \App\Models\Peminjaman::statusOptions()[$item->status] ?? $item->status }}</span>
                                <span>{{ $item->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-600">
                            Belum ada peminjaman.
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
                    <a href="{{ route('mahasiswa.turnitin.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Lihat</a>
                </div>
                <div class="mt-5 space-y-3">
                    @forelse($turnitinSubmissions as $item)
                        <div class="rounded-2xl bg-slate-50 px-4 py-3 ring-1 ring-slate-200/60">
                            <div class="text-sm font-semibold text-slate-900">{{ $item->judul }}</div>
                            <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-slate-600">
                                <span class="rounded-full bg-white px-3 py-1 font-semibold ring-1 ring-slate-200/60">{{ \App\Models\TurnitinSubmission::statusOptions()[$item->status] ?? $item->status }}</span>
                                @if(!is_null($item->similarity_percent))
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 font-semibold text-emerald-700 ring-1 ring-emerald-200/60">{{ $item->similarity_percent }}%</span>
                                @endif
                                <span>{{ $item->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-white p-6 text-sm text-slate-600">
                            Belum ada pengajuan Turnitin.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

