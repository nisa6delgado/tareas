<?php

/**
 * Authentication with Google, require google/apiclient.
 */

class Google
{
    /**
     * Credentials for Facebook app.
     *
     * $credentials array
     */
    public $credentials = [
        'client_id'     => '669872656880-duugogegonl3m817i3j6qb7jnrpc49mr.apps.googleusercontent.com',
        'client_secret' => 'H3ZCeNcL4eIdr9Fllhm9o142',
    ];

    /**
     * Instance of the Google_Client class.
     *
     * $instance object
     */
    public $instance;

    /**
     * Initialize the class to use from a global function.
     *
     * @return Google
     */
    public static function init()
    {
        $class = new static;

        $google_client = new Google_Client();

        $google_client->setClientId($class->credentials['client_id']);
        $google_client->setClientSecret($class->credentials['client_secret']);

        $google_client->addScope('email');
        $google_client->addScope('profile');

        $class->instance = $google_client;

        return $class;
    }

    /**
     * Create URL to log in to Google
     *
     * @param $callback string
     * @return string
     */
    public function url($callback)
    {
    	$this->instance->setRedirectUri($callback);
    	echo $this->instance->createAuthUrl();
    }
}

/**
 * Initialize global helper.
 *
 * @return Google
 */
function google()
{
    return Google::init();
}
