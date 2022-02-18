<?php

use App\Models\Configuration;
use App\Models\Project;
use League\CommonMark\GithubFlavoredMarkdownConverter;

function file_slug(string $file): string
{
    $pathinfo = pathinfo($file);
    $filename = $pathinfo['filename'];
    $extension = $pathinfo['extension'];

    $old = server('DOCUMENT_ROOT') . '/resources/assets/files/' . $file;
    $new = server('DOCUMENT_ROOT') . '/resources/assets/files/' . str()->slug($filename) . '.' . $extension;

    rename($old, $new);

    return str()->slug($filename) . '.' . $extension;
}

function globals(string $var): string
{
    if (isset($_SESSION['user'][$var])) {
        return $_SESSION['user'][$var];
    } else {
        $configuration = Configuration::where('key', $var)->first();
        $_SESSION['user'][$var] = $configuration->value;
        return $configuration->value;
    }
}

function markdown(string $text): string
{
    $converter = new GithubFlavoredMarkdownConverter([
        'html_input' => 'strip',
        'allow_unsafe_links' => false,
    ]);

    return $converter->convert($text);
}

function projects(): object
{
    $projects = Project::orderBy('name')->get();
    return $projects;
}
