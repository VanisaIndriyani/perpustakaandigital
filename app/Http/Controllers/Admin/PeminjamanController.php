<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', '');
        $q = trim((string) $request->query('q', ''));

        $peminjamans = Peminjaman::query()
            ->with(['user', 'koleksi'])
            ->when($status !== '', fn ($query) => $query->where('status', $status))
            ->when($q !== '', function ($query) use ($q) {
                $query->whereHas('user', function ($u) use ($q) {
                    $u->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%");
                })->orWhereHas('koleksi', function ($k) use ($q) {
                    $k->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.peminjaman.index', [
            'peminjamans' => $peminjamans,
            'status' => $status,
            'q' => $q,
            'statusOptions' => Peminjaman::statusOptions(),
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
}

