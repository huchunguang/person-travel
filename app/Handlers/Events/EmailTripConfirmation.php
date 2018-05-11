<?php namespace App\Handlers\Events;

use App\Events\TripWasApproved;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailTripConfirmation {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  TripWasApproved  $event
	 * @return void
	 */
	public function handle(TripWasApproved $event)
	{
		$trip= $event->trip;
		DB::transaction(function()use($trip){
			$trip->update(['status'=>'approved']);
			if ($trip->trip_type=='2'){
				$trip->demostic()->update(['is_approved'=>'1']);
			}
			
		});
		
	}

}
