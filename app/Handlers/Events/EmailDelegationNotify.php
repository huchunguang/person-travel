<?php namespace App\Handlers\Events;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Contacts\SystemVariable;
use App\Events\DelegationNotify;
use App\Delegation;
use Illuminate\Support\Facades\Mail;

class EmailDelegationNotify {
	protected $view;

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(SystemVariable $system)
	{
		//
		$this->system = $system;
	}

	/**
	 * Handle the delegate event.
	 *
	 * @param  Events  $event
	 * @return void
	 */
	public function handle(DelegationNotify $event)
	{
		$delegation = $event->delegation;
		$subject = $this->getSubject($delegation);
// 		dd($delegation->DelegationEndDate);
		$variables=[
			
			'delegation' => $delegation,
			'subject'=>$subject,
			'recipient' => $delegation->delegatedApprover()->first(),
			'viewDetailUrl'=>url('/etravel/dashboard'),
		];
// 		dd($delegation->delegatedApprover()->first()->Email);
		Mail::send($this->view, $variables, function ($message) use ($subject,$delegation) {
			
			$cc = $delegation->delegatedApprover()->first()->Email;
			$to = $delegation->manager()->first()->Email;
			$message->to($to)->cc($cc)->subject("Etravel:".$subject);
		});
			
		
	}
	
	/**
	 * @brief get sender subject,then determine email view name  
	 * @param Delegation $delegation
	 * @return string
	 */
	protected function getSubject(Delegation $delegation)
	{
		$subject = '';
		if ($delegation->EnableDelegation==1){
			$subject = 'You have been chosen as Delegated Approver';
			$this->view = 'emails.delegationNotification';
			
		}elseif ($delegation->EnableDelegation==0){
			$subject = $delegation->manager()->first()->LastName.' '.$delegation->manager()->first()->FirstName.' have been disabled you as his/her delegated approver';
			$this->view = 'emails.delegationNotificationDisabled';
		}
		return $subject;
	}

}
