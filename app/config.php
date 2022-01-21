<?php

return [
	// General
	'application_name' 	=> 'Tareas',
	'version'			=> '1.0.59',

	// Region
	'language' 			=> 'es',
	'timezone' 			=> 'America/Caracas',
	'charset'			=> 'utf-8',
	
	// Environment
	'environment' 		=> 'production',
	'errors' 			=> false,

	// Redirect after login
	'redirect_login' 	=> '/dashboard',

	// Database.
	'database' 		=> [
		[
			'name' 			=> 'default',
			'driver' 		=> 'mysql',
			'host' 			=> 'nisadelgado.com',
			'username' 		=> 'nisadelg_root',
			'database' 		=> 'nisadelg_tareas',
			'password' 		=> 'MlbZKQJqcS-W'
		]
	],

	// Needed to send emails locally.
	'smtp' 				=> [
		'host' 			=> '',
		'username' 		=> '',
		'password'		=> '',
		'port'			=> ''
	],

	// Login with social networks
	'google' => [
		'client_id' 	=> '',
		'client_secret' => '',
		'redirect' 		=> ''
	],

	'facebook' => [
		'app_id'		=> '',
		'app_secret'	=> '',
		'redirect' 		=> ''
	]
];
