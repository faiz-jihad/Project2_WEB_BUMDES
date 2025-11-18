<?php

namespace App\Filament\Widgets;

use App\Models\Berita;
use App\Models\Pesanan;
use Filament\Widgets\Widget;

class NotificationBellWidget extends Widget
{
    protected static ?string $heading = '';
    protected static ?int $sort = 0;
    protected static string $view = 'filament.widgets.notification-bell-widget';
    protected int | string | array $columnSpan = 'full';

    public function getPendingBeritaCount()
    {
        return Berita::where('status', 'pending')->count();
    }

    public function getNewOrdersCount()
    {
        return Pesanan::where('status', 'pending')->count();
    }

    public function getTotalNotifications()
    {
        return $this->getPendingBeritaCount() + $this->getNewOrdersCount();
    }
}
