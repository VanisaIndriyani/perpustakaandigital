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
                                <div class="mt-1 text-xs text-slate-600">{{ $item->created_at->format('d/m/Y H:i') }}</div>
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
                                    <a class="text-sm font-semibold text-emerald-700 hover:text-emerald-800" href="{{ $item->file_doc_url }}" target="_blank" rel="noopener">Unduh</a>
                                @else
                                    <span class="text-xs text-slate-500">—</span>
                                @endif
                            </td>
                            <td class="py-4 pr-4">
                                @if($item->report_pdf_url)
                                    <a class="text-sm font-semibold text-emerald-700 hover:text-emerald-800" href="{{ $item->report_pdf_url }}" target="_blank" rel="noopener">Unduh</a>
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
@endsection

