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
		$user_id=Auth::user()->UserID;
		DB::transaction(function()use($trip,$user_id){
			if ($trip->trip_type=='1'){
// 				var_dump($trip->user_id==$trip->overseas_approver);die;
				if ($user_id == $trip->overseas_approver || $trip->overseas_approver=='' || $trip->department_approver==$trip->overseas_approver || $trip->user_id==$trip->overseas_approver){
					$trip->update(['status'=>'approved']);
				}elseif ($user_id == $trip->department_approver){
					$trip->update(['is_depart_approved'=>'1']);
				}
			}
			
			if ($trip->trip_type=='2'){
				$trip->update(['status'=>'approved']);
				$trip->demostic()->update(['is_approved'=>'1']);
			}
			
		});
		
	}

}
