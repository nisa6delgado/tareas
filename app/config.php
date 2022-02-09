<?php

return [
	// General.
	'application_name' 	=> 'Tareas',
	'version'			=> '1.0.71',

	// Region.
	'language' 			=> 'es',
	'timezone' 			=> 'America/Caracas',
	'charset'			=> 'utf-8',
	
	// Environment.
	'environment' 		=> 'production',
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
