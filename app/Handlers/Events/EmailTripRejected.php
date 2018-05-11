<?php namespace App\Handlers\Events;

use App\Events\TripWasRejected;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\DB;

class EmailTripRejected {

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
	 * @param  TripWasRejected  $event
	 * @return void
	 */
	public function handle(TripWasRejected $event)
	{
		$trip=$event->trip;
		$request=$event->request;
		$approver_comment=$request->input('approver_comment');
		DB::transaction(function()use($trip,$approver_comment){
			$trip->update(['status'=>'rejected','approver_comment'=>$approver_comment]);
			if ($trip->trip_type=='2'){
				$trip->demostic()->update(['is_approved'=>'0']);
			}
		});
	}

}
