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
        $db = DB::table('tasks')
            ->selectRaw('STRFTIME("%d/%m/%Y", DATE(updated_at)) AS date, COUNT(*) AS quantity')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        $labels = array_column($db, 'date');
        $data = array_column($db, 'quantity');
        $colors = count($data);

        return [
            'datasets' => [
                [
                    'label' => __('dashboard.tasks_in_this_date'),
                    'data' => $data,
                    'borderColor' => '#3B82F6',
                    'pointBackgroundColor' => '#3B82F6',
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
