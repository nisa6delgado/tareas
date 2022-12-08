<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use App\Validations\TaskStoreValidation;
use App\Validations\TaskUpdateValidation;
use View;
use Redirect;

class TaskController extends Controller
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
     * Display the specified resource.
     *
     * @param  string $slug
     * @param  int $id
     * @return View
     */
    public function show(string $slug, int $id): View
    {
        $task = Task::find($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $slug
     * @return View
     */
    public function create(string $slug): View
    {
        $project = Project::where('slug', $slug)->first();
        return view('tasks.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskStoreValidation $validation
     * @return Redirect
     */
    public function store(TaskStoreValidation $validation): Redirect
    {
        $project = Project::where('slug', request('slug'))->first();

        $task = Task::create([
            'id_project'    => $project->id,
            'title'         => request('title'),
            'description'   => request('description'),
            'status'        => 0,
            'date_create'   => now('Y-m-d H:i:s'),
            'date_update'   => now('Y-m-d H:i:s')
        ]);

        $slug = $project->slug;

        $files = request('files')->save('resources/assets/files');

        if ($files->filename) {
            foreach($files->filename as $file) {
                File::create([
                    'id_task'       => $task->id,
                    'file'          => file_slug($file),
                    'date_create'   => now('Y-m-d H:i:s'),
                    'date_update'   => now('Y-m-d H:i:s')
                ]);
            }
        }

        return redirect('/projects/show/' . $slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string   $slug
     * @param  int      $id
     * @return View
     */
    public function edit(string $slug, int $id): View
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Redirect
     */
    public function update(TaskUpdateValidation $validation): Redirect
    {
        $task = Task::find(request('id'));
        $task->update([
            'title'         => request('title'),
            'description'   => request('description'),
            'status'        => 0,
            'date_update'   => now('Y-m-d H:i:s')
        ]);

        $files = request('files')->save('resources/assets/files');

        if ($files->filename) {
            foreach($files->filename as $file) {
                $model = File::where('id_task', $task->id)
                    ->where('file', file_slug($file))
                    ->first();

                if ($model) {
                    $model->update([
                        'date_update' => now('Y-m-d H:i:s')
                    ]);

                } else {
                    File::create([
                        'id_task'       => $task->id,
                        'file'          => file_slug($file),
                        'date_create'   => now('Y-m-d H:i:s'),
                        'date_update'   => now('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        return redirect('/tasks/show/' . $task->project->slug . '/' . $task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string   $slug
     * @param  int      $id
     * @return Redirect
     */
    public function delete(string $slug, int $id): Redirect
    {
        $files = File::where('id_task', $id)->get();

        if ($files->count()) {
            foreach ($files as $file) {
                storage()->delete('resources/assets/files/' . $file->file);
            }
        }

        File::where('id_task', $id)->delete();

        Task::find($id)->delete();

        return redirect('/projects/show/' . $slug);
    }
}
