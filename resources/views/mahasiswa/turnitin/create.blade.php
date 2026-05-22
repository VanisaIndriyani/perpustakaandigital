@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <div class="text-sm font-semibold text-emerald-700">Turnitin</div>
                    <div class="text-2xl font-semibold text-slate-900">Ajukan Pengecekan</div>
                    <div class="mt-2 text-sm text-slate-600">Unggah dokumen dalam format PDF/DOC/DOCX.</div>
                </div>
                <a href="{{ route('mahasiswa.turnitin.index') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
            </div>

            <form class="mt-6 space-y-5" method="POST" action="{{ route('mahasiswa.turnitin.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="judul">Judul</label>
                    <input id="judul" name="judul" value="{{ old('judul') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('judul')
                        <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="file_doc">File Dokumen</label>
                    <input id="file_doc" name="file_doc" type="file" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    <div class="text-xs text-slate-600">Maksimal 20MB.</div>
                    @error('file_doc')
                        <div class="text-sm font-semibold text-rose-600">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Kirim</button>
            </form>
        </div>
    </div>
@endsection

