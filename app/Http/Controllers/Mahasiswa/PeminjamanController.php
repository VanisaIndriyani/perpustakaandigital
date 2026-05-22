<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    private const ALLOWED_JENIS = ['buku', 'skripsi', 'ppl-kk'];

    public function index()
    {
        $peminjamans = Peminjaman::query()
            ->with('koleksi')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('mahasiswa.peminjaman.index', [
            'peminjamans' => $peminjamans,
            'statusOptions' => Peminjaman::statusOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'koleksi_id' => ['required', 'integer', 'exists:koleksis,id'],
            'catatan_user' => ['nullable', 'string', 'max:255'],
        ]);

        $koleksi = Koleksi::query()
            ->whereKey($validated['koleksi_id'])
            ->firstOrFail();

        if (!in_array($koleksi->jenis, self::ALLOWED_JENIS, true)) {
            return back()->withErrors([
                'koleksi_id' => 'Koleksi ini tidak tersedia untuk peminjaman.',
            ]);
        }

        $exists = Peminjaman::query()
            ->where('user_id', Auth::id())
            ->where('koleksi_id', $koleksi->id)
            ->whereIn('status', ['requested', 'approved', 'borrowed'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'koleksi_id' => 'Peminjaman untuk koleksi ini masih berjalan.',
            ]);
        }

        Peminjaman::query()->create([
            'user_id' => Auth::id(),
            'koleksi_id' => $koleksi->id,
            'status' => 'requested',
            'catatan_user' => $validated['catatan_user'] ?? null,
        ]);

        return redirect()->route('mahasiswa.peminjaman.index')
            ->with('status', 'Pengajuan peminjaman berhasil dikirim.');
    }
}

