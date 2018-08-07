<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Airline;
use App\User;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);
		$router->model('user','App\User');
		$router->model('trip', 'App\Trip');
		$router->model('purpose', 'App\Trip_purpose');
		$router->model('country', 'App\Country');
		$router->model('announcement', 'App\Trip_announcement');
		$router->model('airline', 'App\Airline');
		$router->model('site', 'App\Site');
		$router->model('overtime', 'App\Overtime');
		$router->model('igg', 'App\Overtime_igg');
		$router->model('shift', 'App\Overtime_shift');
		$router->model('reason', 'App\Overtime_reason');
		$router->model('rate', 'App\Overtime_rate');
		
// 		$router->bind('user', function($value) {
// 			return User::where('name', $value)->first();
// 		});
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
// 			require app_path('Http/routes.php');
			foreach (glob(app_path('Http//Routes').'/*.php') as $file)
			{
				$this->app->make('App\\Http\\Routes\\'.basename($file,'.php'))->map($router);
			}
		});
	}

}
