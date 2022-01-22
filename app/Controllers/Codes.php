<?php

namespace App\Controllers;

class Codes extends Controller
{
	/**
     * File viewers.
     *
     * @return View
     */
	public function view(string $file)
	{
		$fopen = fopen($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files/' . $file, 'r');

		$content = '';

		while (!feof($fopen)) {
			$line = fgets($fopen);
			$content .= $line . '<br>';
		}

		$ext = explode('.', $file)[1];

		return view('codes.view', compact('content', 'ext'));
	}
}
