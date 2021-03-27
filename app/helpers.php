<?php

function description($text)
{
	$text = preg_replace("/((http|https|www)[^\s]+)/", '<a style="color: #858796" target="_blank" href="$1">$0</a>', $text);
    $text = preg_replace("/href=\"www/", 'href="http://www', $text);

    $text = nl2br($text);

	return $text;
}

function modal($file)
{
	$ext = ext($file);

	if (in_array($ext, ['pptx', 'ppt', 'doc', 'docx', 'xls', 'xlsx', 'pdf', 'html', 'txt', 'php', 'js', 'css', 'sql'])) {
		echo 'view-doc';
	}
}

function ext($file)
{
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	$ext = strtolower($ext);
	$ext = explode('?', $ext)[0];
	return $ext;
}

function projects()
{
	$projects = App\Models\Project::where('name', '!=', 'Otros')
		->where('id_user', auth()->id)
		->orderBy('name', 'ASC')
		->get();


	$other = App\Models\Project::where('name', 'Otros')
		->where('id_user', auth()->id)
		->first();


	$projects = $projects->push($other);

	return $projects;
}

function url($file)
{
	$ext = ext($file);
	$ext = strtolower($ext);

	if (in_array($ext, ['pptx', 'ppt', 'doc', 'docx', 'xls', 'xlsx'])) {
		$file = str_replace(' ', '+', $file);
		return 'https://view.officeapps.live.com/op/embed.aspx?src=https://tareas.nisadelgado.com' . $file;
	}

	if (in_array($ext, ['php', 'html', 'js', 'css', 'sql'])) {
		$file = str_replace('/resources/assets/files/', '', $file);
		return 'https://tareas.nisadelgado.com/code/' . $file;
	}

	return $file;
}

function lightbox($file, $title)
{
	$ext = ext($file);
	$ext = strtolower($ext);

	$title = Illuminate\Support\Str::slug($title);

	if (in_array($ext, ['jpg', 'png', 'gif', 'jpeg'])) {
		echo 'data-lightbox="' . $title . '" data-title="' . $file . '"';
	} else {
		echo '';
	}
}

function icon_file($file)
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
