<?php

namespace App\Filament\Widgets;

use App\Models\Koleksi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KoleksiStats extends BaseWidget
{
    protected function getStats(): array
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

        return [
            Stat::make('Total Buku', $totalBuku),
            Stat::make('Total Jurnal', $totalJurnal),
            Stat::make('Total Skripsi', $totalSkripsi),
        ];
    }
}
