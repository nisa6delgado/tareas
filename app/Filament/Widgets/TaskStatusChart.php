<?php

namespace App\Filament\Widgets;

use DB;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class TaskStatusChart extends ChartWidget
{
    protected static ?string $maxHeight = '250px';

    protected static ?array $options = [
        'scales' => [
            'x' => [
                'display' => false,
                'grid' => [
                    'drawOnChartArea' => false,
                ]
            ],
            'y' => [
                'display' => false,
                'grid' => [
                    'drawOnChartArea' => false,
                ]
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
        return __('dashboard.tasks_per_status');
    }
    
    protected function getData(): array
    {
        $completed = __('dashboard.completed');
        $pending = __('dashboard.pending');

        $db = DB::table('tasks')
            ->groupBy('tasks.status')
            ->selectRaw("(CASE tasks.status WHEN 1 THEN '$completed' ELSE '$pending' END) AS status, count(1) AS quantity")
            ->get()
            ->toArray();

        $labels = array_column($db, 'status');
        $data = array_column($db, 'quantity');
        $colors = count($data);

        return [
            'datasets' => [
                [
                    'label' => __('dashboard.tasks_per_status'),
                    'data' => $data,
                    'backgroundColor' => colors($colors),
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
