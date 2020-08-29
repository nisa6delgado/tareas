<?php

$projects = App\Models\Project::orderBy('name')->get();

echo '<h1>Aplicación de tareas</h1>';

foreach ($projects as $project) {
  echo '<b>' . $project->name . '</b><br>';
  
  if ($project->tasks) {
    echo '<ul>';
    foreach ($project->tasks as $task) {
      echo '<li>' . $task->title . '</li>';
    }
    echo '</ul>';
  }  
}