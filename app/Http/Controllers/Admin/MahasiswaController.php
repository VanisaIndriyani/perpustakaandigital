<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function exportPdf(Request $request)
    {
        if (!class_exists(Pdf::class)) {
            abort(500, 'Library PDF belum terpasang di server. Jalankan: composer install (atau composer require barryvdh/laravel-dompdf) lalu php artisan optimize:clear.');
        }

        $q = trim((string) $request->query('q', ''));

        $query = User::query()
            ->where('role', 'mahasiswa')
            ->when($q !== '', function ($q1) use ($q) {
                $q1->where(function ($inner) use ($q) {
                    $inner
                        ->where('name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%");
                });
            })
            ->latest();

        $items = $query->get();

        $base = User::query()->where('role', 'mahasiswa');
        $summary = [
            'total' => (clone $base)->count(),
            'logged_in' => (clone $base)->whereNotNull('last_login_at')->count(),
            'never_login' => (clone $base)->whereNull('last_login_at')->count(),
            'active_7d' => (clone $base)->where('last_login_at', '>=', now()->subDays(7))->count(),
        ];

        $logoPath = public_path('logo.jpeg');
        $logoDataUri = null;
        if (is_file($logoPath)) {
            $logoDataUri = 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($logoPath));
        }

        $pdf = Pdf::loadView('admin.mahasiswa.export_pdf', [
            'items' => $items,
            'q' => $q,
            'logoDataUri' => $logoDataUri,
            'summary' => $summary,
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('mahasiswa-' . now()->format('Ymd-His') . '.pdf');
    }
}
