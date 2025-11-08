<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Berita::count())
                ->description('Total artikel berita')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 12, 15, 18, 22, 25, Berita::count()]),

            Stat::make('Total Produk', Produk::count())
                ->description('Produk yang tersedia')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary')
                ->chart([5, 8, 12, 15, 20, 18, Produk::count()]),

            Stat::make('Total Pesanan', Pesanan::count())
                ->description('Pesanan yang diterima')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning')
                ->chart([3, 6, 9, 12, 15, 18, Pesanan::count()]),

            Stat::make('Total User', User::count())
                ->description('Pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('info')
                ->chart([10, 15, 20, 25, 30, 35, User::count()]),
        ];
    }
}
