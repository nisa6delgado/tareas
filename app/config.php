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

	// Database.
	'database' 		=> [
		[
			'name' 			=> 'default',
			'driver' 		=> 'mysql',
			'host' 			=> 'nisadelgado.com',
			'username' 		=> 'nisadelg_root',
			'database' 		=> 'nisadelg_tareas',
			'password' 		=> '&pRj@hL.gR[A'
		]
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
