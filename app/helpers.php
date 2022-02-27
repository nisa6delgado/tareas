<?php

use App\Models\Configuration;
use App\Models\Project;
use League\CommonMark\GithubFlavoredMarkdownConverter;

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

    return $converter->convert($text);
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
