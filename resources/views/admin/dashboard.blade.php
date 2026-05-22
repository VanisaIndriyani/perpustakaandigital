@extends('admin.layout')

@section('admin-content')
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-3xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-6 shadow-soft">
            <div class="text-sm font-semibold text-emerald-700">Total Buku</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalBuku }}</div>
            <div class="mt-1 text-sm text-slate-600">Buku + E-Book</div>
        </div>
        <div class="rounded-3xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-6 shadow-soft">
            <div class="text-sm font-semibold text-emerald-700">Total Jurnal</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalJurnal }}</div>
            <div class="mt-1 text-sm text-slate-600">Jurnal + E-Jurnal</div>
        </div>
        <div class="rounded-3xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-white p-6 shadow-soft">
            <div class="text-sm font-semibold text-emerald-700">Total Skripsi</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalSkripsi }}</div>
            <div class="mt-1 text-sm text-slate-600">Skripsi</div>
        </div>
    </div>

    <div class="mt-6 grid gap-4 lg:grid-cols-5">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft lg:col-span-3">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <div class="text-sm font-semibold text-slate-900">Diagram Koleksi</div>
                    <div class="mt-1 text-sm text-slate-600">Distribusi jumlah koleksi berdasarkan jenis.</div>
                </div>
                <a href="{{ route('admin.koleksi.index') }}" class="rounded-xl border border-emerald-200 bg-white px-3 py-2 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">Lihat Koleksi</a>
            </div>

            <div class="mt-6 space-y-4">
                @foreach(($chartItems ?? []) as $item)
                    <div class="space-y-2">
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2">
                                <span class="h-2.5 w-2.5 rounded-full {{ $item['color'] }}"></span>
                                <div class="text-sm font-semibold text-slate-900">{{ $item['label'] }}</div>
                            </div>
                            <div class="text-sm font-semibold text-slate-700">{{ $item['total'] }}</div>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100 ring-1 ring-slate-200/60">
                            <div class="h-full rounded-full {{ $item['color'] }}" style="width: {{ $item['percent'] }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft lg:col-span-2">
            <div class="text-sm font-semibold text-slate-900">Kelola Data</div>
            <div class="mt-1 text-sm text-slate-600">Masuk ke menu Koleksi atau Kategori untuk CRUD dan upload file.</div>
            <div class="mt-6 grid gap-2 sm:grid-cols-2 lg:grid-cols-1">
                <a href="{{ route('admin.koleksi.create') }}" class="rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Tambah Koleksi</a>
                <a href="{{ route('admin.kategori.create') }}" class="rounded-2xl border border-emerald-200 bg-white px-4 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">Tambah Kategori</a>
                <a href="{{ route('admin.profile.edit') }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Edit Profil</a>
            </div>
        </div>
    </div>

    <div class="mt-4 rounded-3xl border border-slate-100 bg-white p-6 shadow-soft">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-sm font-semibold text-slate-900">Ringkasan</div>
                <div class="text-sm text-slate-600">Gunakan menu sidebar untuk navigasi cepat.</div>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.koleksi.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Daftar Koleksi</a>
                <a href="{{ route('admin.kategori.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Daftar Kategori</a>
            </div>
        </div>
    </div>
@endsection
