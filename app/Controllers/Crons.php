<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\File;
use App\Models\Task;

class Crons extends Controller
{
	public function clear()
	{
		$files = File::doesntHave('task')->get();

		foreach ($files as $file) {
			if (file_exists('resources/assets/files/' . $file->file)) {
				unlink('resources/assets/files/' . $file->file);
			}
		}

		File::doesntHave('task')->delete();

		Comment::doesntHave('task')->delete();

		Task::doesntHave('project')->delete();
	}
}
