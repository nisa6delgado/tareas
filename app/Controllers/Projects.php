<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use View;
use Redirect;

class Projects extends Controller
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
     * @param  string  $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $project = Project::where('slug', $slug)
            ->with('tasks')
            ->orderByDesc('id')
            ->first();

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Redirect
     */
    public function store(): Redirect
    {
        $slug = str()->slug(request('name'));

        Project::create([
            'name'  => request('name'),
            'icon'  => request('icon'),
            'color' => request('color'),
            'slug'  => $slug
        ]);

        return redirect('/projects/show/' . $slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return View
     */
    public function edit(string $slug): View
    {
        $project = Project::where('slug', $slug)->first();
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Redirect
     */
    public function update(): Redirect
    {
        $slug = str()->slug(request('name'));

        $project = Project::where('slug', request('slug'))->first();
        $project->update([
            'name'  => request('name'),
            'icon'  => request('icon'),
            'color' => request('color'),
            'slug'  => $slug
        ]);

        return redirect('/projects/show/' . $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return Redirect
     */
    public function delete(string $slug): Redirect
    {
        $project = Project::where('slug', $slug)->first();

        $tasks = Task::where('id_project', $project->id)->get();

        foreach ($tasks as $task) {
            $files = File::where('id_task', $task->id)->get();

            if ($files->count()) {
                foreach ($files as $file) {
                    storage()->delete('resources/assets/files/' . $file->file);
                }

                File::where('id_task', $task->id)->delete();
            }

            Task::find($task->id)->delete();
        }

        Project::where('slug', $slug)->delete();

        return redirect('/');
    }
}
