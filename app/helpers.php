<?php

use App\Models\Configuration;
use App\Models\Project;
use League\CommonMark\GithubFlavoredMarkdownConverter;

function file_slug(string $file): string
{
    $basename  = storage()->basename($file);
    $extension = storage()->extension($file);

    $old = 'resources/assets/files/' . $file;
    $new = 'resources/assets/files/' . str()->slug($basename) . '.' . $extension;

    storage()->rename($old, $new);

    return str()->slug($basename) . '.' . $extension;
}

function globals(string $var): string
{
    $configuration = Configuration::where('key', $var)->first();
    return $configuration->value;
}

function markdown(string $text): string
{
    $converter = new GithubFlavoredMarkdownConverter([
        'html_input'         => 'strip',
        'allow_unsafe_links' => false,
    ]);

    return $converter->convert($text);
}

function projects(): object
{
    $projects = Project::orderBy('name')->get();
    return $projects;
}
