<?php

namespace App\Filament\Widgets;

use DB;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class TaskProjectChart extends ChartWidget
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
        return __('dashboard.tasks_per_project');
    }

    protected function getData(): array
    {
        $db = DB::table('projects')
            ->join('tasks', 'projects.id', '=', 'tasks.project_id')
            ->groupBy('projects.id')
            ->selectRaw('projects.name AS project, count(1) AS quantity')
            ->get()
            ->toArray();

        $labels = array_column($db, 'project');
        $data = array_column($db, 'quantity');
        $colors = count($data);

        return [
            'datasets' => [
                [
                    'label' => __('dashboard.tasks_per_project'),
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
