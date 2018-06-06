<?php
namespace App\Http\ViewComposers;

use App\Contacts\SystemVariable;
use Illuminate\Contracts\View\View;
use App\Services\SystemInfo;
use Illuminate\Support\Facades\Auth;
use App\Company_site;

class CheckAdminComposer
{
	public function __construct(SystemVariable $system)
	{
		$this->system=$system;
	}
	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		if (Auth::check()){
			$isEtravelAdmin = Company_site::where('EtravelAdminID',Auth::user()->UserID)->exists();
			$view->with('isEtravelAdmin', $isEtravelAdmin);
		}
	}
}