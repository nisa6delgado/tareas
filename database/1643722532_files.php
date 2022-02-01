<?php

$schema->dropIfExists('files');

$schema->create('files', function ($table) {
	$table->id();
    $table->int('id_task');
    $table->string('file')->unique();

    $table->foreign('id_task')
        ->references('id')
        ->on('tasks');
});
