<?php

$schema['default']->dropIfExists('configurations');

$schema['default']->create('configurations', function ($table) {
	$table->id();
    $table->string('key')->unique();
    $table->string('value')->nullable();
});
