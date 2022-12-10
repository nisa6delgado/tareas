<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Task;
use Redirect;

class MoveController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @return Redirect
     */
    public function update(): Redirect
    {
        $project = Project::find(request('id_project'));

        Task::find(request('id_task'))
            ->update([
                'id_project'    => $project->id,
                'date_update'   => now('Y-m-d H:i:s')
            ]);

        return redirect('/projects/show/' . $project->slug);
    }
}
