<?php

return [
	// General.
	'application_name' 	=> 'Tareas',
	'version'			=> '1.1.19',

	// Region.
	'language' 			=> 'es',
	'timezone' 			=> 'America/Caracas',
	'charset'			=> 'utf-8',
	
	// Environment.
	'environment' 		=> 'development',
	'errors' 			=> true,

	// Database.
	'database' 			=> [
		[
            'name'      => 'default',
            'driver'    => 'sqlite',
            'host'      => '',
            'username'  => '',
            'password'  => '',
            'database'  => 'database/database',
        ]
	]
];
