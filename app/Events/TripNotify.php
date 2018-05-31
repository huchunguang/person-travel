<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;
use App\Trip;
use Illuminate\Http\Request;

class TripNotify extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(Trip $trip,Request $request,$actionType)
	{
		//
		$this->trip=$trip;
		$this->request=$request;
		$this->actionType=$actionType;
	}

}
