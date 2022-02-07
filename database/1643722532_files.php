<?php

$schema['default']->dropIfExists('files');

$schema['default']->create('files', function ($table) {
	$table->id();
    $table->int('id_task');
    $table->string('file')->unique();

    $table->datetime('date_create')
        ->useCurrent();

    $table->datetime('date_update')
        ->useCurrent()
        ->setCurrentOnUpdate();

    $table->foreign('id_task')
        ->references('id')
        ->on('tasks');

    $table->index('file');
});
