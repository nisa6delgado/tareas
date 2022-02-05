<?php

$schema->dropIfExists('projects');

$schema->create('projects', function ($table) {
	$table->id();
    $table->string('name');
    $table->string('icon');
    $table->string('color')->default('black');
    $table->string('slug')->unique();

    $table->index('slug');
});
