<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\Project;
use App\Models\Task;

class Tasks extends Controller
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
     * Create a task.
     *
     * @return string
     */
    public function store(): string
    {
        $task = Task::create([
            'id_project'  => post('id_project'),
            'title'       => post('title'),
            'description' => post('description'),
            'status'      => 0,
        ]);

        $files = files()->input('files')->upload('resources/assets/files');

        if (set($files->filenames)) {
            foreach (json($files->filenames) as $file) {
                File::create([
                    'id_task' => $task->id,
                    'file'    => $file,
                ]);
            }
        }

        $project = Project::find(post('id_project'));

        return $project->slug;
    }

    /**
     * Update a task.
     *
     * @return string
     */
    public function update(): string
    {
        $task = Task::find(post('id'));
        $task->update([
            'title'        => post('title'),
            'description' => post('description'),
        ]);

        return $task->project->slug;
    }

    /**
     * Change status to task.
     *
     * @return string
     */
    public function status()string
    {
        $task = Task::find(post('id'));
        $task->update(['status' => post('status')]);

        $project = Project::find($task->id_project);
        return $project->slug;
    }

    /**
     * Move task to other project.
     *
     * @return string
     */
    public function move(): string
    {
        $task = Task::find(post('id'));
        $task->update(['id_project' => post('id_project')]);

        $project = Project::find($task->id_project);
        return $project->slug;
    }

    /**
     * Delete a task.
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $files = File::where('id_task', $id);

        foreach ($files as $file) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/resources/assets/files/' . $file->file);
        }

        File::where('id_task', $id)->delete();

        Task::find($id)->delete();
    }
}
