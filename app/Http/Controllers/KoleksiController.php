<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class KoleksiController extends Controller
{
    private const JENIS_SLUG_MAP = [
        'buku' => 'buku',
        'e-book' => 'e-book',
        'jurnal' => 'jurnal',
        'e-jurnal' => 'e-jurnal',
        'skripsi' => 'skripsi',
    ];

    public function home()
    {
        $jenisOptions = Koleksi::jenisOptions();

        $latestByJenis = [];
        foreach (array_keys($jenisOptions) as $jenis) {
            $latestByJenis[$jenis] = Koleksi::query()
                ->with('kategori')
                ->where('jenis', $jenis)
                ->latest()
                ->limit(12)
                ->get();
        }

        return view('home', [
            'jenisOptions' => $jenisOptions,
            'latestByJenis' => $latestByJenis,
        ]);
    }

    public function index(Request $request, string $jenisSlug)
    {
        $jenis = self::JENIS_SLUG_MAP[$jenisSlug] ?? null;
        abort_if(!$jenis, 404);

        $q = trim((string) $request->query('q', ''));
        $perPage = (int) $request->query('per_page', 10);
        $allowedPerPage = [10, 12, 24, 48];
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 10;
        }

        $koleksis = Koleksi::query()
            ->with('kategori')
            ->where('jenis', $jenis)
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner
                        ->where('judul', 'like', "%{$q}%")
                        ->orWhere('pengarang', 'like', "%{$q}%")
                        ->orWhere('tahun', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $jenisLabel = Arr::get(Koleksi::jenisOptions(), $jenis, ucfirst($jenis));
        $rekomendasi = Koleksi::query()
            ->where('jenis', $jenis)
            ->latest()
            ->limit(12)
            ->get();

        if ($request->boolean('partial') || $request->ajax()) {
            return view('koleksi._grid', [
                'koleksis' => $koleksis,
                'jenisLabel' => $jenisLabel,
                'perPage' => $perPage,
            ]);
        }

        return view('koleksi.index', [
            'jenis' => $jenis,
            'jenisSlug' => $jenisSlug,
            'jenisLabel' => $jenisLabel,
            'q' => $q,
            'koleksis' => $koleksis,
            'perPage' => $perPage,
            'rekomendasi' => $rekomendasi,
        ]);
    }

    public function show(Koleksi $koleksi)
    {
        $koleksi->loadMissing('kategori');

        return view('koleksi.show', [
            'koleksi' => $koleksi,
        ]);
    }
}
