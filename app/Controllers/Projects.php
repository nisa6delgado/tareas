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
     * @return View
     */
    public function index($slug)
    {
        $project = Project::where('slug', $slug)->first();

        return view('projects/index', compact('project'));
    }

    /**
     * Create a project.
     *
     * @return void
     */
    public function store(): void
    {
        Project::create([
            'id_user'   => auth()->id,
            'name'      => post('name'),
            'color'     => post('color'),
            'icon'      => post('icon'),
            'slug'      => Str::slug(post('name'))
        ]);
    }

    /**
     * Update a proect.
     *
     * @return void
     */
    public function update(): void
    {
        $project = Project::find(post('id'));
        $project->update([
            'name'  => post('name'),
            'color' => post('color'),
            'icon'  => post('icon'),
            'slug'  => Str::slug(post('name')),
        ]);
    }

    /**
     * Delete a proect.
     *
     * @return void
     */
    public function delete(int $id): void
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
