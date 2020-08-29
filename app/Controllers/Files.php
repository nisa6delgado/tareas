<?php

namespace App\Controllers;

use App\Models\File;

class Files extends Controller
{
    /**
     * Verify if user is logged.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('Auth');
    }

    public function store()
    {
    	$files = files()->input('files')->upload('resources/assets/files');

        if (set($files->filenames)) {
            foreach (json($files->filenames) as $file) {
                File::create([
                    'id_task' => post('id_task'),
                    'file'    => $file,
                ]);
            }
        }
    }

    public function delete($id)
    {
        $file = File::find($id);

        unlink($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files/' . $file->file);

        File::find($id)->delete();
    }
}
