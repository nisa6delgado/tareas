<?php

$schema->dropIfExists('tasks');

$schema->create('tasks', function ($table) {
	$table->id();
	$table->integer('id_project');
	$table->string('title');
	$table->text('description');
	$table->boolean('status');
	$table->datetime('date_create')->useCurrent();
	$table->datetime('date_update')->useCurrent()->setCurrentOnUpdate();
});
