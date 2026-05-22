@extends('admin.layout')

@section('admin-content')
    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft sm:p-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="text-sm font-semibold text-emerald-700">Peminjaman</div>
                <div class="text-2xl font-semibold text-slate-900">Kelola Peminjaman</div>
                <div class="mt-2 text-sm text-slate-600">Kelola pengajuan peminjaman dari mahasiswa.</div>
            </div>
        </div>

        @if(session('status'))
            <div class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-6 grid gap-3 md:grid-cols-4" method="GET" action="{{ route('admin.peminjaman.index') }}">
            <input name="q" value="{{ $q }}" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4 md:col-span-2" placeholder="Cari nama / email / nim / judul...">
            <select name="status" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                <option value="">Semua Status</option>
                @foreach($statusOptions as $key => $label)
                    <option value="{{ $key }}" @selected($status === $key)>{{ $label }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button class="w-full rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700" type="submit">Terapkan</button>
                <a class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700 shadow-soft transition hover:bg-slate-50" href="{{ route('admin.peminjaman.index') }}">Reset</a>
            </div>
        </form>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="text-xs font-semibold uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="py-3 pr-4">Mahasiswa</th>
                    <th class="py-3 pr-4">Koleksi</th>
                    <th class="py-3 pr-4">Status</th>
                    <th class="py-3 pr-4">Tanggal</th>
                    <th class="py-3 pr-4">Catatan Admin</th>
                    <th class="py-3 pr-4">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                @foreach($peminjamans as $item)
                    <tr>
                        <td class="py-4 pr-4">
                            <div class="font-semibold text-slate-900">{{ $item->user?->name }}</div>
                            <div class="mt-1 text-xs text-slate-600">{{ $item->user?->nim }} • {{ $item->user?->email }}</div>
                        </td>
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
                            <div class="max-w-[260px] break-words">{{ $item->catatan_admin }}</div>
                        </td>
                        <td class="py-4 pr-4">
                            <form method="POST" action="{{ route('admin.peminjaman.update', $item) }}" class="grid gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                                    @foreach($statusOptions as $key => $label)
                                        <option value="{{ $key }}" @selected($item->status === $key)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <div class="grid grid-cols-1 gap-2">
                                    <input type="date" name="tanggal_pinjam" value="{{ optional($item->tanggal_pinjam)->format('Y-m-d') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                                    <input type="date" name="tanggal_jatuh_tempo" value="{{ optional($item->tanggal_jatuh_tempo)->format('Y-m-d') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                                    <input type="date" name="tanggal_kembali" value="{{ optional($item->tanggal_kembali)->format('Y-m-d') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4">
                                </div>
                                <input name="catatan_admin" value="{{ old('catatan_admin', $item->catatan_admin) }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 shadow-soft outline-none ring-emerald-200 transition focus:border-emerald-300 focus:ring-4" placeholder="Catatan (opsional)">
                                <button type="submit" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-soft transition hover:bg-emerald-700">Simpan</button>
                            </form>
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
@endsection

