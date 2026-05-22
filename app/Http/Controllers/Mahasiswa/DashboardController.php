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

        return view('mahasiswa.dashboard', [
            'peminjamans' => $peminjamans,
            'turnitinSubmissions' => $turnitinSubmissions,
        ]);
    }
}

