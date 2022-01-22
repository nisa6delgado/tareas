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

    /**
     * Create a file.
     *
     * @return void
     */
    public function store(): void
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

    /**
     * Delete a file.
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $file = File::find($id);

        unlink($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files/' . $file->file);

        File::find($id)->delete();
    }
}
