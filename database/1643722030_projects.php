<?php

$schema['default']->dropIfExists('projects');

$schema['default']->create('projects', function ($table) {
	$table->id();
    $table->string('name');
    $table->string('icon');

    $table->string('color')
        ->default('black');

    $table->string('slug')
        ->unique();

    $table->datetime('date_create')
        ->useCurrent();

    $table->datetime('date_update')
        ->useCurrent()
        ->setCurrentOnUpdate();

    $table->index('slug');
});
