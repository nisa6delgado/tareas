<?php

return [
	// General
	'application_name' 	=> 'Tareas',
	'version'			=> '1.0.63',

	// Region
	'language' 			=> 'es',
	'timezone' 			=> 'America/Caracas',
	'charset'			=> 'utf-8',
	
	// Environment
	'environment' 		=> 'production',
	'errors' 			=> true,

    // Redirect after login
    'redirect_login'    => '/dashboard',

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

	// Needed to send emails locally.
    'smtp'              => [
        'host'          => '',
        'username'      => '',
        'password'      => '',
        'port'          => ''
    ],

    // Login with social networks
    'google' => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => ''
    ],

    'facebook' => [
        'app_id'        => '',
        'app_secret'    => '',
        'redirect'      => ''
    ]
];
