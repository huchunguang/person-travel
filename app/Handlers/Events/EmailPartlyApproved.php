<?php namespace App\Handlers\Events;

use App\Events\TripWasPartlyApproved;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\DB;

class EmailPartlyApproved {

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
	 * @param  TripWasPartlyApproved  $event
	 * @return void
	 */
	public function handle(TripWasPartlyApproved $event)
	{
		$trip=$event->trip;
		$request=$event->request;
		DB::transaction(function()use($trip,$request){
			$trip->update(['status'=>'partly-approved','approver_comment'=>$request->input('approver_comment')]);
			foreach ($request->input('id') as $id)
			{
				if ($request->input('is_approve_'.$id) == 'on') {
					$trip->demostic()->where('id',$id)->update(['is_approved'=>'1']);
				}
			}
		});
	}

}
