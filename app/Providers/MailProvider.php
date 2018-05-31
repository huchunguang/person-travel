<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PhpMailer;

class MailProvider extends ServiceProvider {

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
		$this->app->singleton('Mailer',function(){
			return new PhpMailer($To, $Subject, $Body);
		});
// 			$this->app->bind('App\Contacts\SystemVariable',function(){
// 				return new SystemInfo();
// 			});
	}

}
