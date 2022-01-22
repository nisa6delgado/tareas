<?php

$schema->dropIfExists('projects');

$schema->create('projects', function ($table) {
	$table->id();
	$table->integer('id_user');
	$table->string('name');
	$table->text('description');
	$table->string('icon');
	$table->string('color');
	$table->string('slug');
	$table->datetime('date_create')->useCurrent();
	$table->datetime('date_update')->useCurrent()->setCurrentOnUpdate();
});
