<?php namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class checkUserMiddleware {

	/**
	 * Handle an incoming request that to check currently user is or not register
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = false;
		$userName = GetWindowsUsername();
		$userName = 'A6053995';//Nancy
// 		$userName = 'A0009298';//Victor
	    if ($userName){
			$user = User::where('UserName', $userName)->first();
			if (empty($user)) {
				return redirect()->route('unknownUser', [ 
					'userName' => $userName
				]);
			}
		}
// 		echo 123;die;
		Auth::login($user);
// 		dd(Auth::user()->toArray());
	    $addParams = ['userName'=>$userName,'user_id'=>$user['UserID']];
	    $request->attributes->add($addParams);
		return $next($request);
	}

}
