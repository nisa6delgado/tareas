<?php

use League\CommonMark\CommonMarkConverter;

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

function csv($csv)
{
    $lines = explode("\n", $csv);

    $html = '<table><thead><tr>';

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
    $converter = new CommonMarkConverter([
        'html_input' => 'strip',
        'allow_unsafe_links' => false,
    ]);
    
    return $converter->convert($text);
}
