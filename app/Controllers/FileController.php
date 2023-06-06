<?php

namespace App\Controllers;

use App\Models\File;
use Redirect;
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
     * @return View|void
     */
    public function show(int $id): View|void
    {
        if (request('download')) {
            $file = File::find($id);
            storage()->download('resources/assets/files/' . $file->file, $file->file);
        }

        $file = File::find($id);
        return view('files/show', compact('file'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return ?Redirect
     */
    public function delete(int $id): ?Redirect
    {
        $file = File::find($id);

        $id_task = $file->id_task;
        $slug = $file->task->project->slug;

        storage()->delete('resources/assets/files/' . $file->file);
        $file->delete();

        if (request('redirect')) {
            return redirect('/tasks/show/' . $slug . '/' . $id_task);
        }
    }
}
