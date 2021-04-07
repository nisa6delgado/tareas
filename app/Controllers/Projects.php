<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Str;

class Projects extends Controller
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
     * Show home page.
     *
     * @return view
     */
    public function index($slug)
    {
        $project = Project::where('slug', $slug)->first();

        return view('projects/index', compact('project'));
    }

    public function store()
    {
        Project::create([
            'id_user'   => auth()->id,
            'name'      => post('name'),
            'color'     => post('color'),
            'icon'      => post('icon'),
            'slug'      => Str::slug(post('name'))
        ]);
    }

    public function update()
    {
        $project = Project::find(post('id'));
        $project->update([
            'name'  => post('name'),
            'color' => post('color'),
            'icon'  => post('icon'),
            'slug'  => Str::slug(post('name')),
        ]);
    }

    public function delete($id)
    {
        $tasks = Task::where('id_project', $id);

        foreach ($tasks as $task) {
            $files = File::where('id_task', $task->id);

            foreach ($files as $file) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files/' . $file->file);
            }

            File::where('id_task', $task->id)->delete();
        }

        Task::where('id_project', $id)->delete();

        Project::find($id)->delete();
    }
}
