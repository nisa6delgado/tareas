<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class TaskProjectChartWidget extends ChartWidget
{
    protected static ?string $maxHeight = '250px';

    protected static ?array $options = [
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
        $labels = Project::pluck('name')->toArray();

        return [
            'datasets' => [
                [
                    'label' => __('dashboard.tasks_per_project'),
                    'data' => [12],
                    'backgroundColor' => colors(1),
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
