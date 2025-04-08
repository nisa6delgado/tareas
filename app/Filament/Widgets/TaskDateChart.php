<?php

namespace App\Filament\Widgets;

use DB;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;

class TaskDateChart extends ChartWidget
{
    public $db;
    public $min;
    public $max;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '250px';

    public function __construct()
    {
        $this->db = DB::table('activity_log')
            ->selectRaw('STRFTIME("%d/%m/%Y", DATE(updated_at)) AS datef, DATE(updated_at) AS date, COUNT(*) AS quantity')
            ->groupBy('datef')
            ->orderBy('date')
            ->get()
            ->toArray();

        $this->min = min(array_column($this->db, 'quantity')) - 1;
        $this->max = max(array_column($this->db, 'quantity')) + 1;
    }

    public function getHeading(): string|Htmlable
    {
        return __('dashboard.tasks_per_date');
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'min' => $this->min,
                    'max' => $this->max,
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
    }

    protected function getData(): array
    {
        $labels = array_column($this->db, 'datef');
        $data = array_column($this->db, 'quantity');

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
