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
	'environment' 		=> 'development',
	'errors' 			=> true,

	// Database.
	'database' 			=> [
		[
            'name'      => 'default',
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'username'  => 'root',
            'password'  => '',
            'database'  => 'tareas',
        ]
	]
];
