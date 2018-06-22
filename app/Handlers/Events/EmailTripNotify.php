<?php namespace App\Handlers\Events;

use App\Events\TripNotify;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Contacts\SystemVariable;
use App\Trip;

class EmailTripNotify {

	/**
	 * Create the event handler.
	 * 
	 * @return void
	 */
	public function __construct(SystemVariable $system)
	{
		$this->system = $system;
	}

	/**
	 * Handle the event.
	 *
	 * @param  TripNotify  $event
	 * @return void
	 */
	public function handle(TripNotify $event)
	{
		$actionType = $event->actionType;
		$trip = $event->trip;
		$tripCreater = User::find($trip->user_id);
		$request = $event->request;
		if ($trip->trip_type==1){
			$travelType = 'International';
			$viewDetailUrl = route('internationalDetail',['trip'=>$trip->trip_id]);
		}else{
			$travelType = 'Domestic';
			
			$viewDetailUrl = route('domesticDetail',['trip'=>$trip->trip_id]);
		}
		if ($trip->overseas_approver && $trip->is_depart_approved)
		{
			$manager = User::find($trip->overseas_approver);
		}else{
			$manager = User::find($trip->department_approver);
		}
		$recipient=$trip->user()->first();
		$subject = $this->getSubject($travelType, $actionType, $tripCreater,$trip);
		$variables=[
			
			'trip' => $trip,
			'subject'=>$subject,
			'recipient' => Auth::user()->UserID == $trip->user_id?$manager:$recipient,
			'viewDetailUrl'=>$viewDetailUrl,
		];
// 		dd($variables);
		$flag = Mail::send('emails.workflowNotify', $variables, function ($message) use ($subject,$manager,$trip,$tripCreater,$request) {
			
			$cc = $trip->cc ?: [ ];
			if (Auth::user()->UserID == $trip->user_id) {
				$to = $manager->Email;
				array_push($cc,$tripCreater->Email);
			}else{
				$to = $tripCreater->Email;
				array_push($cc,$manager->Email);
			}
			if ($request->input('status') == 'approved'){
				
				if ($this->system->adminEmail) {
					array_push($cc, $this->system->adminEmail);
				}
				
			}
// 			dd($cc);

			$message->to($to)->cc($cc)->subject("Etravel:".$subject);
			
		});
		if($flag){
			Log::info('send notify email successfully', ['id' => $trip->trip_id,'variables'=>$variables]);
		}else{
			Log::info('failed to send notify email', ['id' => $trip->trip_id,'variables'=>$variables]);
		}
	}
	public function getSubject($travelType,$actionType,$tripCreater,$trip)
	{
		$subject='';
		$userLastName=Auth::user()->LastName;
		$userFirstName=Auth::user()->FirstName;
		if ($actionType=='submitted'){
			$subject = "{$userLastName} {$userFirstName} ".ucfirst($actionType)." {$travelType} Travel Request# {$trip->reference_id} for your approval";
		}elseif ($actionType=='pending'){
			$subject = "{$userLastName} {$userFirstName} updated {$travelType} travel request for your approval";
		}elseif ($actionType=='approved' || $actionType=='partly-approved' || $actionType=='rejected'){
			$subject = "{$travelType} Travel Request# {$trip->reference_id} has been {$actionType}";
		}elseif ($actionType=='cancelled'){
			$subject = "{$userLastName} {$userFirstName} {$actionType} his {$travelType} travel request";
		}
		return $subject;
	}
}



