<?php

$schema['default']->dropIfExists('configurations');

$schema['default']->create('configurations', function ($table) {
	$table->id();

    $table->string('key')
        ->unique();

    $table->string('value')
        ->nullable();

    $table->datetime('date_create')
        ->useCurrent();

    $table->datetime('date_update')
        ->useCurrent()
        ->setCurrentOnUpdate();
});
