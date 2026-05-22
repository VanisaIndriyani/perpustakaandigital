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
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="py-3 pr-4">Koleksi</th>
                        <th class="py-3 pr-4">Status</th>
                        <th class="py-3 pr-4">Tanggal</th>
                        <th class="py-3 pr-4">Catatan</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                    @foreach($peminjamans as $item)
                        <tr>
                            <td class="py-4 pr-4">
                                <div class="font-semibold text-slate-900">{{ $item->koleksi?->judul }}</div>
                                <div class="mt-1 text-xs text-slate-600">{{ $item->koleksi?->pengarang }}</div>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="inline-flex items-center rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60">
                                    {{ $statusOptions[$item->status] ?? $item->status }}
                                </span>
                            </td>
                            <td class="py-4 pr-4 text-xs text-slate-600">
                                <div>Diajukan: {{ $item->created_at->format('d/m/Y H:i') }}</div>
                                @if($item->tanggal_pinjam)
                                    <div>Pinjam: {{ $item->tanggal_pinjam->format('d/m/Y') }}</div>
                                @endif
                                @if($item->tanggal_jatuh_tempo)
                                    <div>Jatuh tempo: {{ $item->tanggal_jatuh_tempo->format('d/m/Y') }}</div>
                                @endif
                                @if($item->tanggal_kembali)
                                    <div>Kembali: {{ $item->tanggal_kembali->format('d/m/Y') }}</div>
                                @endif
                            </td>
                            <td class="py-4 pr-4 text-xs text-slate-600">
                                @if($item->catatan_admin)
                                    <div><span class="font-semibold text-slate-800">Admin:</span> {{ $item->catatan_admin }}</div>
                                @endif
                                @if($item->catatan_user)
                                    <div class="mt-1"><span class="font-semibold text-slate-800">Saya:</span> {{ $item->catatan_user }}</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $peminjamans->links() }}
            </div>
        </div>
    </div>
@endsection

