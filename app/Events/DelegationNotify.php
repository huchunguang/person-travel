<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use App\Delegation;
use Illuminate\Http\Request;

class DelegationNotify extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Delegation $delegation,Request $request)
	{
		//
		$this->delegation = $delegation;
		$this->request = $request;
	}

}
