@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Kategori</div>
                <div class="text-2xl font-semibold text-slate-900">Edit Kategori</div>
            </div>
            <a href="{{ route('admin.kategori.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
        </div>

        <form class="mt-6 space-y-4" method="POST" action="{{ route('admin.kategori.update', $kategori) }}">
            @csrf
            @method('PUT')

            <div class="space-y-1">
                <label class="text-sm font-semibold text-slate-700" for="nama_kategori">Nama Kategori</label>
                <input id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                @error('nama_kategori')
                    <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Update</button>
                <a href="{{ route('admin.kategori.index') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Batal</a>
            </div>
        </form>
    </div>
@endsection

