<?php

namespace App\Filament\Widgets;

use DB;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class TaskDateChart extends ChartWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '250px';

    protected static ?array $options = [
        'scales' => [
            'y' => [
                'min' => 0,
                'ticks' => [
                    'stepSize' => 1,
                ],
            ],
        ],
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    public function getHeading(): string|Htmlable
    {
        return __('dashboard.tasks_per_date');
    }

    protected function getData(): array
    {
        $db = DB::table('activity_log')
            ->selectRaw('STRFTIME("%d/%m/%Y", DATE(updated_at)) AS datef, DATE(updated_at) AS date, COUNT(*) AS quantity')
            ->groupBy('datef')
            ->orderBy('date')
            ->get()
            ->toArray();

        $labels = array_column($db, 'datef');
        $data = array_column($db, 'quantity');

        return [
            'datasets' => [
                [
                    'label' => __('dashboard.tasks_in_this_date'),
                    'data' => $data,
                    'borderColor' => colors(1),
                    'pointBackgroundColor' => colors(1),
                ]
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
