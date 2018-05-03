<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SystemInfo;

class SystemServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('System',function(){
			return new SystemInfo();
		});
		$this->app->bind('App\Contacts\SystemVariable',function(){
			return new SystemInfo();
		});
	}

}
