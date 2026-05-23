@extends('layouts.app')

@section('content')
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-2 lg:items-stretch">
        <div class="relative overflow-hidden rounded-3xl border border-emerald-100/70 bg-gradient-to-br from-emerald-600 via-emerald-600 to-emerald-700 p-6 text-white shadow-soft sm:p-8">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
            <div class="absolute -bottom-24 -left-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>

            <div class="relative space-y-6">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-white/90 ring-1 ring-white/20">
                        Turnitin
                    </div>
                    <h1 class="text-3xl font-semibold leading-tight">Ajukan pengecekan dokumen.</h1>
                    <div class="text-sm text-white/90">Upload file lalu pantau statusnya di daftar Turnitin.</div>
                </div>

                <div class="grid gap-3 text-sm text-white/90">
                    <div class="flex items-start gap-3 rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15">
                        <span class="mt-0.5 grid h-7 w-7 place-items-center rounded-full bg-white/10 text-xs font-semibold ring-1 ring-white/20">1</span>
                        <div>
                            <div class="font-semibold">Isi judul</div>
                            <div class="text-white/80">Gunakan judul sesuai dokumen yang diajukan.</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15">
                        <span class="mt-0.5 grid h-7 w-7 place-items-center rounded-full bg-white/10 text-xs font-semibold ring-1 ring-white/20">2</span>
                        <div>
                            <div class="font-semibold">Upload dokumen</div>
                            <div class="text-white/80">Format PDF/DOC/DOCX, maksimal 20MB.</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-2xl bg-white/10 px-4 py-3 ring-1 ring-white/15">
                        <span class="mt-0.5 grid h-7 w-7 place-items-center rounded-full bg-white/10 text-xs font-semibold ring-1 ring-white/20">3</span>
                        <div>
                            <div class="font-semibold">Tunggu hasil</div>
                            <div class="text-white/80">Admin akan mengupdate status dan similarity.</div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-white/10 px-4 py-3 text-sm ring-1 ring-white/15">
                    <div class="font-semibold">Catatan</div>
                    <div class="mt-1 text-white/85">Pastikan file bisa dibuka dan isi dokumen sudah final sebelum dikirim.</div>
                </div>

                <a href="{{ route('mahasiswa.turnitin.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-emerald-700 shadow-soft transition hover:bg-emerald-50">
                    <svg viewBox="0 0 24 24" fill="none" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kembali ke daftar
                </a>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
            <div class="absolute -left-20 -top-20 h-56 w-56 rounded-full bg-emerald-50 blur-2xl"></div>
            <div class="relative space-y-6">
                <div class="space-y-1">
                    <div class="text-sm font-semibold text-emerald-700">Form Pengajuan</div>
                    <div class="text-2xl font-semibold text-slate-900">Submit Turnitin</div>
                    <div class="text-sm text-slate-600">Lengkapi data lalu upload dokumen.</div>
                </div>

                @if($errors->any())
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        <div class="font-semibold">Periksa lagi input kamu:</div>
                        <ul class="mt-1 list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-5" method="POST" action="{{ route('mahasiswa.turnitin.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-700" for="judul">Judul</label>
                        <input id="judul" name="judul" value="{{ old('judul') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Contoh: Skripsi - Analisis Sistem ..." required autofocus>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between gap-3">
                            <label class="text-sm font-semibold text-slate-700" for="file_doc">File Dokumen</label>
                            <span class="text-xs text-slate-500">PDF / DOC / DOCX • Maks 20MB</span>
                        </div>

                        <label class="group block cursor-pointer rounded-3xl border border-dashed border-slate-200 bg-slate-50 px-5 py-5 shadow-soft transition hover:border-emerald-200 hover:bg-emerald-50/50">
                            <input id="file_doc" name="file_doc" type="file" class="hidden" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                            <div class="flex items-start gap-4">
                                <span class="grid h-12 w-12 place-items-center rounded-2xl bg-white text-emerald-700 ring-1 ring-emerald-200/60 shadow-soft">
                                    <svg viewBox="0 0 24 24" fill="none" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M14 2v6h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 18v-7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M9 14l3-3 3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <div class="min-w-0">
                                    <div class="text-sm font-semibold text-slate-900">Klik untuk pilih file</div>
                                    <div class="mt-1 text-sm text-slate-600">Pastikan file dapat dibuka dan ukurannya tidak melebihi 20MB.</div>
                                    <div id="file_doc_meta" class="mt-2 hidden rounded-2xl bg-white px-3 py-2 text-xs font-semibold text-slate-700 ring-1 ring-slate-200/60"></div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <button type="submit" class="flex-1 rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">
                            Kirim Pengajuan
                        </button>
                        <a href="{{ route('mahasiswa.turnitin.index') }}" class="flex-1 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('change', (event) => {
        const input = event.target;
        if (!(input instanceof HTMLInputElement)) return;
        if (input.id !== 'file_doc') return;

        const meta = document.getElementById('file_doc_meta');
        if (!meta) return;

        const file = input.files && input.files.length ? input.files[0] : null;
        if (!file) {
            meta.classList.add('hidden');
            meta.textContent = '';
            return;
        }

        const sizeMb = (file.size / 1024 / 1024).toFixed(2);
        meta.textContent = `${file.name} • ${sizeMb} MB`;
        meta.classList.remove('hidden');
    });
</script>
@endpush
