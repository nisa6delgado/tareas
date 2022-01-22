<?php

$schema->dropIfExists('comments');

$schema->create('comments', function ($table) {
	$table->id();
	$table->integer('id_task');
	$table->text('comment');
	$table->datetime('date_create')->useCurrent();
	$table->datetime('date_update')->useCurrent()->setCurrentOnUpdate();
});
