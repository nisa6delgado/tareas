<?php

use App\Models\Configuration;
use App\Models\Project;

function file_slug($file)
{
    $pathinfo = pathinfo($file);
    $filename = $pathinfo['filename'];
    $extension = $pathinfo['extension'];

    $old = server('DOCUMENT_ROOT') . '/resources/assets/files/' . $file;
    $new = server('DOCUMENT_ROOT') . '/resources/assets/files/' . str()->slug($filename) . '.' . $extension;

    rename($old, $new);

    return str()->slug($filename) . '.' . $extension;
}

function globals($var)
{
    if (isset($_SESSION['user'][$var])) {
        return $_SESSION['user'][$var];
    } else {
        $configuration = Configuration::where('key', $var)->first();
        $_SESSION['user'][$var] = $configuration->value;
        return $configuration->value;
    }
}

function projects()
{
    $projects = Project::where('name', '!=', 'Otros')->orderBy('name')->get();
    return $projects;
}
