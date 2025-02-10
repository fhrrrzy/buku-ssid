<?php

namespace App\Filament\Widgets;

use App\Models\OPD;
use App\Models\Bidang;
use App\Models\Wifi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s'; // Penyegaran otomatis setiap 10 detik
    protected ?string $heading = 'Stats Overview';

    protected function getStats(): array
    {
        return [
            Stat::make('Total OPD', OPD::count())
                ->description('Jumlah total OPD')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary'),

            Stat::make('Total Bidang', Bidang::count())
                ->description('Jumlah total Bidang')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('success'),

            Stat::make('Total Perangkat WiFi', Wifi::count())
                ->description('Jumlah total perangkat WiFi')
                ->descriptionIcon('heroicon-o-wifi')
                ->color('info'),
        ];
    }
}
