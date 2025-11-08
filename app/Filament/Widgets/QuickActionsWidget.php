<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected static ?string $heading = 'Aksi Cepat';
    protected static ?int $sort = 5;
    protected static string $view = 'filament.widgets.quick-actions-widget';

    protected int | string | array $columnSpan = 'full';

    public function getColumns(): int
    {
        return 3;
    }
}
