<?php

namespace App\Controllers;

use App\Models\Task;
use Redirect;

class Status extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  int      $id_task
     * @param  string   $status
     * @return Redirect
     */
    public function update(int $id_task, string $status): Redirect
    {
        $task = Task::find($id_task);
        $status = ($status == 'done') ? 1 : 0;
        $task->update(['status' => $status]);
        return redirect('/tasks/show/' . $task->project->slug . '/' . $id_task);
    }
}
