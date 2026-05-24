<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Koleksi;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function buktiPdf(Peminjaman $peminjaman)
    {
        if ((int) $peminjaman->user_id !== (int) Auth::id()) {
            abort(403);
        }

        if (!in_array($peminjaman->status, ['approved', 'borrowed', 'returned'], true)) {
            abort(404);
        }

        $peminjaman->loadMissing(['user', 'koleksi']);

        $logoPath = public_path('logo.jpeg');
        $logoDataUri = null;
        if (is_file($logoPath)) {
            $logoDataUri = 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($logoPath));
        }

        $pdf = Pdf::loadView('mahasiswa.peminjaman.bukti_pdf', [
            'peminjaman' => $peminjaman,
            'logoDataUri' => $logoDataUri,
            'generatedAt' => now(),
            'statusOptions' => Peminjaman::statusOptions(),
        ])->setPaper('a4', 'portrait');

        return $pdf->download('bukti-peminjaman-' . $peminjaman->id . '.pdf');
    }
}
