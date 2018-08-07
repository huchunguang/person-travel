<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Overtime;
use Illuminate\Http\Request;

class OvertimeNotify extends Event
{
	
	use SerializesModels;

	/**
	 * Create a new overtime emailer instance.
	 * 
	 * @return void
	 */
	public function __construct(Overtime $overtime, Request $request, $action_type)
	{
		$this->overtime = $overtime;
		$this->request = $request;
		$this->action_type = $action_type;
	}

}
