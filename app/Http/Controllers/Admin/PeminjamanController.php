<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', '');
        $q = trim((string) $request->query('q', ''));

        $baseQuery = Peminjaman::query()
            ->with(['user', 'koleksi'])
            ->when($q !== '', function ($query) use ($q) {
                $query->whereHas('user', function ($u) use ($q) {
                    $u->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%");
                })->orWhereHas('koleksi', function ($k) use ($q) {
                    $k->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%");
                });
            });

        $peminjamans = (clone $baseQuery)
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $summaryQuery = Peminjaman::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->whereHas('user', function ($u) use ($q) {
                    $u->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%");
                })->orWhereHas('koleksi', function ($k) use ($q) {
                    $k->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%");
                });
            });

        $summary = [
            'total' => (clone $summaryQuery)->count(),
            'requested' => (clone $summaryQuery)->where('status', 'requested')->count(),
            'approved' => (clone $summaryQuery)->where('status', 'approved')->count(),
            'rejected' => (clone $summaryQuery)->where('status', 'rejected')->count(),
            'borrowed' => (clone $summaryQuery)->where('status', 'borrowed')->count(),
            'returned' => (clone $summaryQuery)->where('status', 'returned')->count(),
        ];

        return view('admin.peminjaman.index', [
            'peminjamans' => $peminjamans,
            'status' => $status,
            'q' => $q,
            'statusOptions' => Peminjaman::statusOptions(),
            'summary' => $summary,
        ]);
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:requested,approved,rejected,borrowed,returned'],
            'tanggal_pinjam' => ['nullable', 'date'],
            'tanggal_jatuh_tempo' => ['nullable', 'date'],
            'tanggal_kembali' => ['nullable', 'date'],
            'catatan_admin' => ['nullable', 'string', 'max:255'],
        ]);

        $peminjaman->update($validated);

        return back()->with('status', 'Peminjaman diperbarui.');
    }

    public function exportPdf(Request $request)
    {
        $status = (string) $request->query('status', '');
        $q = trim((string) $request->query('q', ''));

        $query = Peminjaman::query()
            ->with(['user', 'koleksi'])
            ->when($status !== '', fn ($q1) => $q1->where('status', $status))
            ->when($q !== '', function ($q1) use ($q) {
                $q1->whereHas('user', function ($u) use ($q) {
                    $u->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%");
                })->orWhereHas('koleksi', function ($k) use ($q) {
                    $k->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%");
                });
            })
            ->latest();

        $items = $query->get();

        $logoPath = public_path('logo.jpeg');
        $logoDataUri = null;
        if (is_file($logoPath)) {
            $logoDataUri = 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($logoPath));
        }

        $pdf = Pdf::loadView('admin.peminjaman.export_pdf', [
            'items' => $items,
            'status' => $status,
            'q' => $q,
            'logoDataUri' => $logoDataUri,
            'statusOptions' => Peminjaman::statusOptions(),
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('peminjaman-' . now()->format('Ymd-His') . '.pdf');
    }
}
