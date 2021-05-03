<?php

return [
	// General
	'application_name' 	=> 'Tareas',
	'version'			=> '1.0.0',

	// Region
	'language' 			=> 'es',
	'timezone' 			=> 'America/Caracas',
	'charset'			=> 'utf-8',
	
	// Environment
	'environment' 		=> 'production',
	'errors' 			=> true,

	// Database
	'database' 			=> [
		'driver' 		=> 'mysql',
		'host' 			=> 'localhost',
		'username' 		=> 'root',
		'database' 		=> 'tareas',
		'password' 		=> ''
	],

	// Facebook login
	'facebook'			=> [
		'app_id' 		=> '',
		'app_secret' 	=> ''
	],

	// Google login
	'google'			=> [
		'client_id' 	=> '',
		'client_secret' => ''
	],
];
