<?php namespace App\Http\Middleware;

use Closure;
use App\User;

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
	    $userIsExisted=false;
	    
	    $userName=GetWindowsUsername();
	    if ($userName){
	        $userIsExisted = User::where('UserName',$userName)->get()->toArray();
	        if(empty($userIsExisted)){
	            return redirect()->route('unknownUser',['userName'=>$userName]);
	        }
	    }
	    $addParams = ['userName'=>$userName];
	    $request->attributes->add($addParams);
		return $next($request);
	}

}
