@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Koleksi</div>
                <div class="text-2xl font-semibold text-slate-900">Daftar Koleksi</div>
                <div class="mt-2 text-sm text-slate-600">CRUD koleksi, cover, dan file PDF.</div>
            </div>

            <a href="{{ route('admin.koleksi.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Tambah Koleksi</a>
        </div>

        <form class="mt-6 grid gap-3 md:grid-cols-4" method="GET" action="{{ route('admin.koleksi.index') }}">
            <input name="q" value="{{ $q }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4 md:col-span-2" placeholder="Cari judul / pengarang / tahun...">

            <select name="jenis" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                <option value="">Semua Jenis</option>
                @foreach($jenisOptions as $key => $label)
                    <option value="{{ $key }}" @selected($jenis === $key)>{{ $label }}</option>
                @endforeach
            </select>

            <select name="kategori_id" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected((string) $kategoriId === (string) $kategori->id)>{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>

            <div class="flex flex-wrap gap-2 md:col-span-4">
                <button class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-slate-800" type="submit">Terapkan</button>
                <a class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50" href="{{ route('admin.koleksi.index') }}">Reset</a>
            </div>
        </form>

        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Cover</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Judul</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Meta</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-600">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($koleksis as $koleksi)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-4 py-3">
                                <div class="h-12 w-10 overflow-hidden rounded-lg bg-slate-100 ring-1 ring-slate-200">
                                    @if($koleksi->cover_url)
                                        <img src="{{ $koleksi->cover_url }}" alt="{{ $koleksi->judul }}" class="h-full w-full object-cover">
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="max-w-md">
                                    <div class="text-sm font-semibold text-slate-900">{{ $koleksi->judul }}</div>
                                    <div class="mt-1 text-xs text-slate-600">{{ $koleksi->pengarang }} · {{ $koleksi->tahun ?? '—' }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200/60">
                                        {{ $jenisOptions[$koleksi->jenis] ?? $koleksi->jenis }}
                                    </span>
                                    @if($koleksi->kategori)
                                        <span class="rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60">{{ $koleksi->kategori->nama_kategori }}</span>
                                    @endif
                                    @if($koleksi->file_pdf_url)
                                        <a href="{{ $koleksi->file_pdf_url }}" target="_blank" rel="noopener" class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60 hover:bg-slate-50">PDF</a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.koleksi.edit', $koleksi) }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Edit</a>
                                    <form method="POST" action="{{ route('admin.koleksi.destroy', $koleksi) }}" onsubmit="return confirm('Hapus koleksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-xl border border-rose-200 bg-white px-3 py-2 text-sm font-semibold text-rose-700 shadow-soft transition hover:bg-rose-50">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6 text-sm text-slate-600" colspan="4">Belum ada koleksi.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $koleksis->links() }}
        </div>
    </div>
@endsection

