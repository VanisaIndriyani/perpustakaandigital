<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Koleksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalBuku = Koleksi::query()
            ->whereIn('jenis', ['buku', 'e-book'])
            ->count();

        $totalJurnal = Koleksi::query()
            ->whereIn('jenis', ['jurnal', 'e-jurnal'])
            ->count();

        $totalSkripsi = Koleksi::query()
            ->where('jenis', 'skripsi')
            ->count();

        $countsByJenis = Koleksi::query()
            ->select('jenis', DB::raw('count(*) as total'))
            ->groupBy('jenis')
            ->pluck('total', 'jenis')
            ->all();

        $chartItems = [];
        $jenisOptions = Koleksi::jenisOptions();
        $max = 1;

        foreach ($jenisOptions as $key => $label) {
            $total = (int) ($countsByJenis[$key] ?? 0);
            $max = max($max, $total);
            $chartItems[] = [
                'key' => $key,
                'label' => $label,
                'total' => $total,
            ];
        }

        $chartItems = array_map(function (array $item) use ($max) {
            $item['percent'] = (int) round(($item['total'] / $max) * 100);
            $item['color'] = match ($item['key']) {
                'buku' => 'bg-emerald-600',
                'e-book' => 'bg-emerald-700',
                'jurnal' => 'bg-lime-600',
                'e-jurnal' => 'bg-green-600',
                'skripsi' => 'bg-amber-500',
                default => 'bg-emerald-600',
            };
            return $item;
        }, $chartItems);

        return view('admin.dashboard', [
            'totalBuku' => $totalBuku,
            'totalJurnal' => $totalJurnal,
            'totalSkripsi' => $totalSkripsi,
            'chartItems' => $chartItems,
        ]);
    }
}
