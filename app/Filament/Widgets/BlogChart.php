<?php

namespace App\Filament\Widgets;

use App\Models\Blog;
use App\Models\ClientRequest;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class BlogChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static string $color = 'success';
    protected static ?int $sort =2;
    public function getHeading(): string
    {
        return __("messages.blog");
    }
    protected function getData(): array
    {

        $data = Trend::model(Blog::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();
        return [
            'datasets' => [
                [
                    'label' => 'blog',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],


        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
