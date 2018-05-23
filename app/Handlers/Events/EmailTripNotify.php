<?php namespace App\Handlers\Events;

use App\Events\TripNotify;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EmailTripNotify {

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
	 * @param  TripNotify  $event
	 * @return void
	 */
	public function handle(TripNotify $event)
	{
		$actionType=$event->actionType;
		$trip=$event->trip;
		$tripCreater = User::find($trip->user_id);
		$request=$event->request;
		if ($trip->trip_type==1){
			$travelType='INTERNATIONAL';
			$viewDetailUrl=url("etravel/tripnationallist/{$trip->trip_id}");
		}else{
			
			$travelType='DOMESTIC';
			$viewDetailUrl=url("etravel/tripdemosticlist/{$trip->trip_id}");
		}
		
		if ($trip->overseas_approver && $trip->is_depart_approved)
		{
			$manager= User::find($trip->overseas_approver);
		}else{
			$manager=User::find($trip->department_approver);
		}
		$recipient=$trip->user()->first();
		$subject = "Etravel: {$travelType} request has been {$actionType} by applicant.";
		$variables=[
			
			'recipient' => $recipient,
			'manager' => $manager,
			'trip' => $trip,
			'travelType' => $travelType,
			'actionType' => $actionType,
			'viewDetailUrl'=>$viewDetailUrl,
		];
			// dd($viewDetailUrl);
			// echo view('emails.workflowNotify',$variables);die
		$flag = Mail::send('emails.workflowNotify', $variables, function ($message) use ($subject,$manager,$trip,$tripCreater) {
			$cc = $trip->cc;
			if (Auth::user()->UserID == $trip->user_id) {
				$to = $manager->Email;
				array_push($cc,$tripCreater->Email);
			}else{
				$to = $tripCreater->Email;
				array_push($cc,$manager->Email);
			}
// 			dd($cc);
			$message->to($to)->cc($cc)->subject($subject);
			
		});
		if($flag){
			Log::info('send notify email successfully', ['id' => $trip->trip_id,'variables'=>$variables]);
		}else{
			Log::info('failed to send notify email', ['id' => $trip->trip_id,'variables'=>$variables]);
		}
	}

}
