<?php

namespace App\Handlers\Events;

use App\Events\OvertimeNotify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;
use App\Contacts\SystemVariable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\User;

class EmailOvertimeNotify
{

	/**
	 * Create the event handler.
	 * 
	 * @return void
	 */
	public function __construct(Mail $mail, SystemVariable $system)
	{
		$this->mail = $mail;
		$this->system = $system;
	}

	/**
	 * Handle the event.
	 * 
	 * @param OvertimeNotify $event        	
	 * @return void
	 */
	public function handle(OvertimeNotify $event)
	{
		$actionType = $event->action_type;
		$overtime= $event->overtime;
		$overtimeCreater = $overtime->user()->first();
		$request = $event->request;
		$viewDetailUrl='';
		$manager = $overtime->hr_approver()->first();
		$recipient = $overtime->user()->first();
		$subject = $this->getEmailSubject($actionType, $overtimeCreater, $overtime);
		// dd($subject);
		$variables = [ 
			
			'overtime' => $overtime,
			'subject' => $subject,
			'recipient' => Auth::user()->UserID == $overtime->user_id ? $manager : $recipient,
			'viewDetailUrl' => $viewDetailUrl
		];
		// dd($variables);
		$flag = Mail::send('emails.workflowNotify', $variables, function ($message) use ($subject, $manager, $overtime, $overtimeCreater, $actionType) {
			
			$cc = $overtime->cc ?: [ ];
			if (Auth::user()->UserID == $overtime->user_id) {
				$to = $manager->Email;
				array_push($cc, $overtimeCreater->Email);
			}else {
				$to = $overtimeCreater->Email;
				array_push($cc, $manager->Email);
			}
			
			// dd($cc);
			
			$message->to($to)
				->cc($cc)
				->subject("Overtime:" . $subject);
		});
		if ($flag) {
			Log::info('send notify overtime email successfully', [ 
				
				'id' => $overtime->reference_id,
				'variables' => $variables
			]);
		} else {
			Log::info('failed to send overtime notify email', [ 
				
				'id' => $overtime->reference_id,
				'variables' => $variables
			]);
		}
	}

	public function getEmailSubject($actionType, $tripCreater, $trip)
	{
		$subject = '';
		$userLastName = Auth::user()->LastName;
		$userFirstName = Auth::user()->FirstName;
		if ($actionType == 'submitted') {
			$subject = "{$userLastName} {$userFirstName} " . ucfirst($actionType) . " Overtime Request# {$trip->reference_id} for your approval";
		} elseif ($actionType == 'pending') {
			$subject = "{$userLastName} {$userFirstName} updated overtime request for your approval";
		} elseif ($actionType == 'rejected') {
			$subject = "Overtime Request# {$trip->reference_id} has been {$actionType}";
		} elseif ($actionType == 'partly-approved') {
			$subject = "Overtime Request# {$trip->reference_id} has been partially approved";
		} elseif ($actionType == 'approved') {
			$subject = "Overtime Request# {$trip->reference_id} has been fully approved";
		}elseif ($actionType=='cancelled'){
			$subject = "{$userLastName} {$userFirstName} {$actionType} his overtime request";
		}
		return $subject;
	}
}
