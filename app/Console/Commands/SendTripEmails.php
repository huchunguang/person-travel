<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Trip;
use App\Repositories\TripRepository;
use Carbon\Carbon;
use App\Trip_flight;

class SendTripEmails extends Command
{

	/**
	 * The console command name.
	 * 
	 * @var string
	 */
	protected $name = 'tripEmails:send';

	/**
	 * The console command description.
	 * 
	 * @var string
	 */
	protected $description = 'Send mail if there is a international trip in three days';

	/**
	 * Create a new command instance.
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 * 
	 * @return mixed
	 */
	public function fire()
	{
		$notifyUserList = array ();
		$queueSwitch = $this->option('queue');
		$mailUser = $this->argument('user');
		$userPriKey = 'UserID';
		$userColumns=[$userPriKey,'LastName','FirstName','Email'];
		$flightColumns=['flight_date','etd_time','flight_to'];
		if ($mailUser) {
			$mailUserObj = User::where('UserName', $mailUser)->first($userColumns);
			if (! $mailUserObj) {
				$this->error('Gave the username did not found');
			}
			$notifyUserList = $mailUserObj;
			unset($mailUserObj);
		} else {
			$notifyUserList = User::where('is_notify_trip', 1)->get($userColumns);
		}
		if (isset($notifyUserList) && empty($notifyUserList)) return false;
		if ($queueSwitch) {
			$notifyUserList->each(function ($user, $key)use($flightColumns) {
				$tripIdArr = $user->tripList()
					->where('status', Trip::APPROVED)
					->where('daterange_from', '>=', Carbon::now()->format('m/d/Y'))
					->get([ 
					
					'trip_id'
				]);
				$tripIdArr = array_pluck($tripIdArr, 'trip_id');
// 				dd($tripIdArr);
				$toNotifyFlight = Trip_flight::whereIn('trip_id', $tripIdArr)->orderBy('flight_date', 'DESC')
					->get($flightColumns)
					->filter(function ($user) {
					return ($user->flight_date == Carbon::parse('+3 days')->format('m/d/Y'));
				});
				foreach ($toNotifyFlight->chunk(10) as $chunk) {
					foreach ($chunk as $flight) {
// 						dd($user->FirstName);
// 						dd($flight->flight_date);
// 						dd($flight->etd_time);
// 						dd($flight->flight_to);
						$subject = $this->getMailSubject($user, $flight);
						Mail::queue('emails.incomingTripReminder',['user'=>$user,'flight'=>$flight],function($message)use($user,$subject){
							$message->to($user->Email)->subject($subject);
						});
					}
				}
			});
			
			
		} else {
			$this->info('switched to directly send mail');
// 			Mail::send();
		}
	}
	
	protected function getMailSubject($user,$flight)
	{
		return "Reminder:  Incoming Trip on {$flight->flight_date}({$flight->flight_to})";
	}
	/**
	 * Get the console command arguments.
	 * 
	 * @return array
	 */
	protected function getArguments()
	{
		return [ 
			
			[ 
				
				'user',
				InputArgument::OPTIONAL,
				'a user\'s UserName in the user table'
			]
		];
	}

	/**
	 * Get the console command options.
	 * 
	 * @return array
	 */
	protected function getOptions()
	{
		return [ 
			
			[ 
				
				'queue',
				null,
				InputOption::VALUE_NONE,
				'to determine if push console task into queue',
				null
			]
		];
	}
}
