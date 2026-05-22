@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Kategori</div>
                <div class="text-2xl font-semibold text-slate-900">Daftar Kategori</div>
                <div class="mt-2 text-sm text-slate-600">Kelola kategori koleksi.</div>
            </div>

            <div class="flex w-full flex-col gap-2 sm:flex-row md:max-w-xl">
                <form class="flex w-full gap-2" method="GET" action="{{ route('admin.kategori.index') }}">
                    <input name="q" value="{{ $q }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Cari kategori...">
                    <button class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-slate-800" type="submit">Cari</button>
                </form>
                <a href="{{ route('admin.kategori.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Tambah</a>
            </div>
        </div>

        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-600">Jumlah</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-600">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse($kategoris as $kategori)
                        <tr class="hover:bg-slate-50/60">
                            <td class="px-4 py-3 text-sm font-semibold text-slate-900">{{ $kategori->nama_kategori }}</td>
                            <td class="px-4 py-3 text-sm text-slate-600">{{ $kategori->koleksis_count }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.kategori.edit', $kategori) }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50">Edit</a>
                                    <form method="POST" action="{{ route('admin.kategori.destroy', $kategori) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-xl border border-rose-200 bg-white px-3 py-2 text-sm font-semibold text-rose-700 shadow-soft transition hover:bg-rose-50">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-4 py-6 text-sm text-slate-600" colspan="3">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $kategoris->links() }}
        </div>
    </div>
@endsection

