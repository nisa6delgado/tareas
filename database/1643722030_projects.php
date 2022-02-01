<?php

$schema->dropIfExists('projects');

$schema->create('projects', function ($table) {
	$table->id();
    $table->string('name');
    $table->string('icon');
    $table->string('color')->nullable()->default('black');
    $table->string('slug')->unique();
});
