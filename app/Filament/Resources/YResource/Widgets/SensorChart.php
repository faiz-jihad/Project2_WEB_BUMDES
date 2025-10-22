<?php

namespace App\Filament\Resources\YResource\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\SensorData;

class SensorChart extends ApexChartWidget
{
    protected static ?string $chartId = 'SensorChart';
    protected static ?string $heading = 'Grafik Suhu & Kelembapan';

    protected function getOptions(): array
    {
        $data = SensorData::latest()->take(20)->get()->reverse();
        return [
            'chart' => ['type' => 'line'],
            'xaxis' => ['categories' => $data->pluck('created_at')->map->format('H:i')],
            'series' => [
                ['name' => 'Suhu (°C)', 'data' => $data->pluck('temperature')],
                ['name' => 'Kelembapan (%)', 'data' => $data->pluck('humidity')],
            ],
        ];
    }
}

