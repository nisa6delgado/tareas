<?php

return [
	// General.
	'application_name' 	=> 'Base PHP',
	'version'			=> '1.2.60',

	// Region.
	'language' 			=> 'es',
	'timezone' 			=> 'America/Caracas',
	'charset'			=> 'utf-8',
	
	// Environment.
	'environment' 		=> 'development',
	'errors' 			=> true,

	// Redirect after login
	'redirect_login' 	=> '/dashboard',

	// Database.
	'database' 			=> [
		[
            'name'      => 'default',
            'driver'    => 'mysql',
            'host'      => 'nisadelgado.com',
            'username'  => 'nisadelg_root',
            'password'  => '&pRj@hL.gR[A',
            'database'  => 'nisadelg_tareas',
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
