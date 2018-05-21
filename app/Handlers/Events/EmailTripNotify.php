<?php namespace App\Handlers\Events;

use App\Events\TripNotify;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Log;

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
		$request=$event->request;
		if ($trip->trip_type==1){
			$travelType='INTERNATIONAL';
			$viewDetailUrl=url("/etravel/tripnationallist/{$trip->trip_id}");
		}else{
			
			$travelType='DOMESTIC';
			$viewDetailUrl=url("/etravel/tripdemosticlist/{$trip->trip_id}");
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
		// 		dd($variables);
		// 		echo view('emails.workflowNotify',$variables);die
		$flag = Mail::send('emails.workflowNotify', $variables, function ($message) use ($subject) {
			$to = '383702275@qq.com';
			$message->to($to)
				->cc([ 
				'huchunguang123@gmail.com','15152364392@163.com'])->subject($subject);
		});
		if($flag){
			Log::info('send notify email successfully', ['id' => $trip->trip_id,'variables'=>$variables]);
		}else{
			Log::info('failed to send notify email', ['id' => $trip->trip_id,'variables'=>$variables]);
		}
	}

}
