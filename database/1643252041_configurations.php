<?php

$schema->dropIfExists('configurations');

$schema->create('configurations', function ($table) {
	$table->id();
    $table->string('key');
    $table->string('value');
	$table->datetime('date_create')->useCurrent();
	$table->datetime('date_update')->useCurrent()->setCurrentOnUpdate();
});
