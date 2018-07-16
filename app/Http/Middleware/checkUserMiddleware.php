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
		if (!Auth::check()) {
			$user = false;
			$userName = GetWindowsUsername();
			//$userName = 'A6053995';//Available Window Account Of Nancy for testing
			//$userName = 'A0009298';//Available Window Account Of Victor for testing A6197955 chaoyi
			if ($userName){
				$user = User::where('UserName', $userName)->first();
				if (empty($user)) {
					return redirect()->route('unknownUser', [
						'userName' => $userName
					]);
				}
			}else{
				return redirect('auth/login');
			}
			Auth::login($user);
			
		}
		$addParams = ['userName'=>Auth::user()->UserName,'user_id'=>Auth::user()->UserID];
		$request->attributes->add($addParams);
		return $next($request);
	}

}
