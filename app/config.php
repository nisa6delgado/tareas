<?php

return [
	// General.
	'application_name' => 'Tareas',
	'version' => '1.1.90',
	'maintenance' => false,

	// Region.
	'language' => 'es',
	'timezone' => 'America/Caracas',
	'charset' => 'utf-8',
	
	// Environment.
	'environment' => 'production',
	'errors' => false,

	// Database.
	'database' => [
		[
            'name' => 'default',
            'driver' => 'sqlite',
            'host' => '',
            'username' => '',
            'password' => '',
            'database' => 'database/database',
            'port' => ''
        ]
	]
];
