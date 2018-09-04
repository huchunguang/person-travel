<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
		'App\Console\Commands\SendTripEmails'
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
// 		$schedule->command('inspire')->hourly();
// 		$schedule->command('tripEmails:send')->daily();
		$schedule->command('queue:listen')->withoutOverlapping();
		$schedule->command('tripEmails:send --queue')->withoutOverlapping();
	}

}
