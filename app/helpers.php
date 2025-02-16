<?php

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
    $colors = [
        '#EF4444',
        '#3B82F6',
        '#F59E0B',
        '#22C55E',
        '#6366F1',
        '#EAB308',
        '#F97316',
        '#A855F7',
        '#F43F5E',
        '#14B8A6',
    ];
    
    shuffle($colors);
    
    return array_slice($colors, 0, $quantity);
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
        'code' => 'Código',
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
