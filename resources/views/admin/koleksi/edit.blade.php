@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Koleksi</div>
                <div class="text-2xl font-semibold text-slate-900">Edit Koleksi</div>
            </div>
            <a href="{{ route('admin.koleksi.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Kembali</a>
        </div>

        <form class="mt-6 space-y-6" method="POST" action="{{ route('admin.koleksi.update', $koleksi) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-1 md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700" for="judul">Judul</label>
                    <input id="judul" name="judul" value="{{ old('judul', $koleksi->judul) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('judul') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="pengarang">Pengarang</label>
                    <input id="pengarang" name="pengarang" value="{{ old('pengarang', $koleksi->pengarang) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                    @error('pengarang') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="tahun">Tahun</label>
                    <input id="tahun" name="tahun" type="number" value="{{ old('tahun', $koleksi->tahun) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                    @error('tahun') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="jenis">Jenis</label>
                    <select id="jenis" name="jenis" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                        @foreach($jenisOptions as $key => $label)
                            <option value="{{ $key }}" @selected(old('jenis', $koleksi->jenis) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('jenis') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-sm font-semibold text-slate-700" for="kategori_id">Kategori</label>
                    <select id="kategori_id" name="kategori_id" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" required>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" @selected((string) old('kategori_id', $koleksi->kategori_id) === (string) $kategori->id)>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-sm font-semibold text-slate-700" for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="5" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">{{ old('deskripsi', $koleksi->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <div class="text-sm font-semibold text-slate-700">Cover</div>
                    @if($koleksi->cover_url)
                        <div class="flex items-center gap-3">
                            <div class="h-16 w-12 overflow-hidden rounded-xl bg-slate-100 ring-1 ring-slate-200">
                                <img src="{{ $koleksi->cover_url }}" alt="{{ $koleksi->judul }}" class="h-full w-full object-cover">
                            </div>
                            <div class="text-sm text-slate-600">Upload cover baru untuk mengganti.</div>
                        </div>
                    @endif
                    <input id="cover" name="cover" type="file" accept="image/jpeg,image/png,image/webp" class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-soft">
                    @error('cover') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>

                <div class="space-y-2">
                    <div class="text-sm font-semibold text-slate-700">File PDF</div>
                    @if($koleksi->file_pdf_url)
                        <a href="{{ $koleksi->file_pdf_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Lihat PDF Saat Ini</a>
                    @endif
                    <input id="file_pdf" name="file_pdf" type="file" accept="application/pdf" class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-soft">
                    @error('file_pdf') <div class="text-sm font-semibold text-rose-600">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="submit" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Update</button>
                <a href="{{ route('admin.koleksi.index') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Batal</a>
            </div>
        </form>
    </div>
@endsection

