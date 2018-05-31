<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
			view()->composer(
				['/etravel/trip/demosticCreate','/etravel/trip/create','/etravel/trip/nationalEdit','/etravel/admin/triplist/index','/etravel/trip/demosticEdit'], 'App\Http\ViewComposers\CommonComposer'
				);
// 			view()->composer(
// 				['/etravel/trip/create','/etravel/trip/nationalEdit'], 'App\Http\ViewComposers\TripComposer'
// 				);
			
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
