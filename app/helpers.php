<?php

use App\Models\Configuration;
use App\Models\Project;
use Illuminate\Support\Str;

function ext($file)
{
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    $ext = explode('?', $ext)[0];
    return $ext;
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

function icon($file)
{
    $ext = ext($file);
    $ext = strtolower($ext);

    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        return 'far fa-file-image';
    }

    if (in_array($ext, ['html', 'php', 'css', 'json', 'js', 'htaccess'])) {
        return 'far fa-file-code';
    }

    if (in_array($ext, ['doc', 'docx'])) {
        return 'far fa-file-word';
    }

    if (in_array($ext, ['ppt', 'pptx'])) {
        return 'far fa-file-powerpoint';
    }

    if (in_array($ext, ['xls', 'xlsx'])) {
        return 'far fa-file-excel';
    }

    if (in_array($ext, ['pdf'])) {
        return 'far fa-file-pdf';
    }

    if (in_array($ext, ['zip', 'rar'])) {
        return 'fas fa-file-archive';
    }

    return 'fa fa-file';
}

function projects()
{
    $projects = Project::where('name', '!=', 'Otros')->orderBy('name')->get();
    return $projects;
}

function str()
{
    return new Str;
}

function url($file)
{
    $ext = ext($file);
    $ext = strtolower($ext);

    if (in_array($ext, ['pptx', 'ppt', 'doc', 'docx', 'xls', 'xlsx'])) {
        $file = str_replace(' ', '+', $file);
        return 'https://view.officeapps.live.com/op/embed.aspx?src=https://tareas.nisadelgado.com/resources/assets/files/' . $file;
    }

    return '/resources/assets/files/' . $file;
}
