<?php

$schema->dropIfExists('files');

$schema->create('files', function ($table) {
	$table->id();
	$table->integer('id_task');
	$table->string('file');
	$table->datetime('date_create')->useCurrent();
	$table->datetime('date_update')->useCurrent()->setCurrentOnUpdate();
});
