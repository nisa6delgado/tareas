<?php

$schema->dropIfExists('configurations');

$schema->create('configurations', function ($table) {
	$table->id();
    $table->string('key')->unique();
    $table->string('value')->nullable();
});
