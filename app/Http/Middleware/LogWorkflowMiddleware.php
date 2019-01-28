<?php namespace App\Http\Middleware;

use Closure;
use App\Trip;
use Illuminate\Support\Facades\Auth;

class LogWorkflowMiddleware {

	/**
	 * log a workflow info when the ending of requestting of trip .
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$response = $next($request);
		$trip = session('trip');
		$trip = Trip::find($trip->trip_id);
		$user = Auth::user();
		$message = $trip->status . ' by: ' . $user->LastName . ' ' . $user->FirstName . ' on ' . $trip->updated_at;
		\Log::notice($message, [ 
			
			'trip_id' => $trip->trip_id,
		]);
		return $response;
	}

}
