<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $base = User::query()->where('role', 'mahasiswa');

        $mahasiswas = (clone $base)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner
                        ->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $summary = [
            'total' => (clone $base)->count(),
            'logged_in' => (clone $base)->whereNotNull('last_login_at')->count(),
            'never_login' => (clone $base)->whereNull('last_login_at')->count(),
            'active_7d' => (clone $base)->where('last_login_at', '>=', now()->subDays(7))->count(),
        ];

        return view('admin.mahasiswa.index', [
            'q' => $q,
            'summary' => $summary,
            'mahasiswas' => $mahasiswas,
        ]);
    }
}

