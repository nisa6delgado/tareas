<?php

namespace App\Controllers;

use App\Models\File;

class Files extends Controller
{
    /**
     * Verify if user is logged.
     *
     * @return auth
     */
    public function __construct()
    {
        $this->middleware('Auth');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function delete(int $id): void
    {
        $file = File::find($id);
        storage()->delete('resources/assets/files/' . $file->file);
        $file->delete();
    }
}
