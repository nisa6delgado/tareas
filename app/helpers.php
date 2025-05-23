<?php

use App\Models\Config;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

function checklist($checklist)
{
    $lines = explode("\n", $checklist);

    $html = '<div>';

    foreach ($lines as $line) {
        $html .= str_replace(
            [
                '[ ]',
                '[x]'
            ],
            [
                '<input type="checkbox" disabled>',
                '<input type="checkbox" checked disabled>',
            ],
            $line
        ) . '<br>';
    }

    $html .= '</div>';
    return $html;
}

function colors($quantity)
{
    $color = Config::where('key', 'color')->first();
    $color = $color ? $color->value : '#000000';

    if ($quantity > 1) {
        for ($i = 1; $i <= $quantity; $i++) {
            $colors[] = $color;
        }
        
    } else {
        $colors = $color;
    }

    return $colors;
}

function csv($csv)
{
    $lines = explode("\n", $csv);

    $html = '<table class="csv"><thead><tr>';

    foreach (explode(';', $lines[0]) as $item) {
        $html .= '<th>' . $item . '</th>';
    }

    $html .= '</tr></thead><tbody>';

    unset($lines[0]);

    foreach ($lines as $line) {
        $html .= '<tr>';

        foreach (explode(';', $line) as $item) {
            $html .= '<td>' . $item . '</td>';
        }

        $html .= '</tr>';
    }

    $html .= '</tbody></table>';
    return $html;
}

function formts()
{
    return collect([
        'checklist' => 'Checklist',
        'code' => __('tasks.code'),
        'csv' => 'CSV',
        'html' => 'HTML',
        'markdown' => 'Markdown',
    ]);
}

function markdown($text)
{
    $config = [
        'table' => [
            'wrap' => [
                'enabled' => false,
                'tag' => 'div',
                'attributes' => [],
            ],
            'alignment_attributes' => [
                'left'   => ['align' => 'left'],
                'center' => ['align' => 'center'],
                'right'  => ['align' => 'right'],
            ],
        ],
    ];

    $environment = new Environment($config);
    $environment->addExtension(new CommonMarkCoreExtension());

    $environment->addExtension(new TableExtension());

    $converter = new MarkdownConverter($environment);
    
    $converter = $converter->convert($text);
    $converter = str_replace('<a href', '<a target="_blank" href', $converter);

    return $converter;
}
