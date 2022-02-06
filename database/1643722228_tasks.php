<?php

$schema['default']->dropIfExists('tasks');

$schema['default']->create('tasks', function ($table) {
	$table->id();
    $table->int('id_project');
    $table->string('title');
    $table->text('description')->nullable();
    $table->boolean('status');

    $table->foreign('id_project')
        ->references('id')
        ->on('projects');
});
