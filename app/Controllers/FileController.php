<?php

namespace App\Controllers;

use App\Models\File;
use View;

class FileController extends Controller
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function show(int $id): View
    {
        $file = File::find($id);
        return view('files/show', compact('file'));
    }
}
