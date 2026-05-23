<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\TurnitinSubmission;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $userId = Auth::id();
        $user = Auth::user();

        $peminjamans = Peminjaman::query()
            ->with('koleksi')
            ->where('user_id', $userId)
            ->latest()
            ->limit(8)
            ->get();

        $turnitinSubmissions = TurnitinSubmission::query()
            ->where('user_id', $userId)
            ->latest()
            ->limit(8)
            ->get();

        $peminjamanCounts = [
            'total' => Peminjaman::query()->where('user_id', $userId)->count(),
            'requested' => Peminjaman::query()->where('user_id', $userId)->where('status', 'requested')->count(),
            'borrowed' => Peminjaman::query()->where('user_id', $userId)->where('status', 'borrowed')->count(),
            'returned' => Peminjaman::query()->where('user_id', $userId)->where('status', 'returned')->count(),
        ];

        $turnitinCounts = [
            'total' => TurnitinSubmission::query()->where('user_id', $userId)->count(),
            'submitted' => TurnitinSubmission::query()->where('user_id', $userId)->where('status', 'submitted')->count(),
            'checking' => TurnitinSubmission::query()->where('user_id', $userId)->where('status', 'checking')->count(),
            'completed' => TurnitinSubmission::query()->where('user_id', $userId)->where('status', 'completed')->count(),
        ];

        return view('mahasiswa.dashboard', [
            'user' => $user,
            'peminjamans' => $peminjamans,
            'turnitinSubmissions' => $turnitinSubmissions,
            'peminjamanCounts' => $peminjamanCounts,
            'turnitinCounts' => $turnitinCounts,
        ]);
    }
}
