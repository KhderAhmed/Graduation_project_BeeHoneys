<?php

namespace App\Filament\Widgets;

use App\Models\HiveReading;
use Filament\Widgets\ChartWidget;

class MyReadingsChart extends ChartWidget
{
    protected static ?string $heading = 'Hive Readings (آخر 7 أيام)';
    protected static string $color = 'pink';
     protected static ?int $sort =3;

    protected function getData(): array
    {
        $readings = HiveReading::query()
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => '🌡 الحرارة',
                    'data' => $readings->pluck('temperature'),
                    'borderColor' => '#f87171',
                ],
                [
                    'label' => '💧 الرطوبة',
                    'data' => $readings->pluck('humidity'),
                    'borderColor' => '#60a5fa',
                ],
                [
                    'label' => '⚖ الوزن',
                    'data' => $readings->pluck('weight'),
                    'borderColor' => '#34d399',
                ],
            ],
            'labels' => $readings->pluck('created_at')->map(fn($date) => $date->format('d/m H:i')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
