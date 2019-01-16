<?php namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GuzzleHttp\Client;

trait ResetsPasswords {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * The password broker implementation.
	 *
	 * @var PasswordBroker
	 */
	protected $passwords;

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return Response
	 */
	public function getEmail()
	{
		return view('auth.password');
	}
	
	protected $_passwordResetApi='http://SW02Q604/api/changePasswordapi.php';
	/**
	 * Send a reset link to the given user.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function postEmail(Request $request)
	{
		$this->validate($request, ['Email' => 'required|email']);
		
		$response = $this->passwords->sendResetLink($request->only('Email'), function($m)
		{
			$m->subject($this->getEmailSubject());
		});
		
		switch ($response)
		{
			case PasswordBroker::RESET_LINK_SENT:
				return redirect()->back()->with('status', trans($response));

			case PasswordBroker::INVALID_USER:
				return redirect()->back()->withErrors(['email' => trans($response)]);
		}
	}

	/**
	 * Get the e-mail subject line to be used for the reset link email.
	 *
	 * @return string
	 */
	protected function getEmailSubject()
	{
		return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token))
		{
			throw new NotFoundHttpException();
		}

		return view('auth.reset')->with('token', $token);
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function postReset(Request $request)
	{
		$this->validate($request, [
			'token' => 'required',
			'Email' => 'required|email',
		]);

		$credentials = $request->only(
			'Email', 'Pwd', 'Pwd_confirmation', 'token'
		);
		
		$response = $this->passwords->reset($credentials, function($user, $password)
		{
			$user->Pwd = md5($password);
			
			$user->save();
			$postData=array();
			$postData['userid']='1584';
			$postData['password']='12345';
			$this->notifyResetApi($postData);
			$this->auth->login($user);
		});

		switch ($response)
		{
			case PasswordBroker::PASSWORD_RESET:
				return redirect($this->redirectPath());

			default:
				return redirect()->back()
							->withInput($request->only('Email'))
							->withErrors(['email' => trans($response)]);
		}
	}
	
	public function notifyResetApi($postData)
	{
		$client= new Client();
		$response = $client->post($this->_passwordResetApi,['body'=>$postData]);
		if ($response->getStatusCode()=='200'){
			return true;
		}
		return false;
		
	}
	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
	}

}
