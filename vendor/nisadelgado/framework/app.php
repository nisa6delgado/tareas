<?php



use Illuminate\Container\Container;

use Illuminate\Events\EventServiceProvider;

use Illuminate\Support\Facades\Facade;

use Illuminate\Http\Request;

use Illuminate\Routing\RoutingServiceProvider;

use Whoops\Handler\PrettyPageHandler;

use Whoops\Run;



/**

 * Start framework.

 */

class App

{

	/**

	 * Start framework.

	 *

	 * @return void

	 */

	public static function run()

	{

		ini_set('session.cache_expire', 259200);
		ini_set('session.cache_limiter', 'none');
		ini_set('session.cookie_lifetime', 259200);
		ini_set('session.gc_maxlifetime', 259200);



		session_start();



		header('Access-Control-Allow-Origin: *');



		date_default_timezone_set('America/Caracas');



		$whoops = new Run;

		$whoops->prependHandler(new PrettyPageHandler);

		$whoops->register();



		$app = new Container;

		Facade::setFacadeApplication($app);

		$app['app'] = $app;

		$app['env'] = 'production';

		with(new EventServiceProvider($app))->register();

		with(new RoutingServiceProvider($app))->register();



		$route = $app['router'];

		include 'app/routes.php';



		if (file_exists('app/helpers.php')) {

			include 'app/helpers.php';

		}



		$request  = Request::createFromGlobals();

		$response = $app['router']->dispatch($request);

		$response->send();

	}

}

