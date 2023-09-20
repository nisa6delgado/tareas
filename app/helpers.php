<?php

use App\Models\Configuration;
use App\Models\Project;
use League\CommonMark\GithubFlavoredMarkdownConverter;

/**
 * Convert string in checklist.
 *
 * @param string $checklist
 * @return void
 */
function checklist(string $checklist): void
{
    $lines = explode("\n", $checklist);

    echo '<div>';

    foreach ($lines as $line) {
        echo str_replace(
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

    echo '</div>';
}

/**
 * Convert CSV in table HTML.
 *
 * @param string $csv
 * @return void
 */
function csv(string $csv): void
{
    $lines = explode("\n", $csv);

    echo '<table><thead><tr>';

    foreach (explode(';', $lines[0]) as $item) {
        echo '<th>' . $item . '</th>';
    }

    echo '</tr></thead><tbody>';

    unset($lines[0]);

    foreach ($lines as $line) {
        echo '<tr>';

        foreach (explode(';', $line) as $item) {
            echo '<td>' . $item . '</td>';
        }

        echo '</tr>';
    }

    echo '</tbody></table>';
}

/**
 * Return slug for filename given.
 *
 * @param string $file
 * @return string
 */
function file_slug(string $file): string
{
    $basename  = storage()->basename($file);
    $extension = storage()->extension($file);

    $old = 'resources/assets/files/' . $file;
    $new = 'resources/assets/files/' . str()->slug($basename) . '.' . $extension;

    storage()->rename($old, $new);

    return str()->slug($basename) . '.' . $extension;
}

/**
 * Show format for select.
 *
 * @return string
 */
function formats(): string
{
    $formats = [        
        ['id' => 'checklist', 'name' => 'Checklist'],
        ['id' => 'code', 'name' => 'Código'],
        ['id' => 'csv', 'name' => 'CSV'],
        ['id' => 'html', 'name' => 'HTML'],
        ['id' => 'markdown', 'name' => 'Markdown'],
    ];

    return json($formats);
}

/**
 * Get config value for key given.
 *
 * @param string $var
 * @return string
 */
function globals(string $var): string
{
    $configuration = Configuration::where('key', $var)->first();
    return $configuration->value;
}

/**
 * Convert in HTML the markdown given.
 *
 * @param string $text
 * @return string
 */
function markdown(string $text): string
{
    $converter = new GithubFlavoredMarkdownConverter([
        'html_input'         => 'strip',
        'allow_unsafe_links' => false,
    ]);

    $converter = $converter->convert($text);
    $converter = str_replace('<a href', '<a target="_blank" href', $converter);

    return $converter;
}

/**
 * Get projects to show in sidebar
 *
 * @return object
 */
function projects(): object
{
    $projects = Project::orderBy('name')->get();
    return $projects;
}
