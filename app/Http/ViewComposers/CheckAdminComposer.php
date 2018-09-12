<?php
namespace App\Http\ViewComposers;

use App\Contacts\SystemVariable;
use Illuminate\Contracts\View\View;
use App\Services\SystemInfo;
use Illuminate\Support\Facades\Auth;
use App\Company_site;
use App\Repositories\TripRepository;

class CheckAdminComposer
{
	public function __construct(SystemVariable $system,TripRepository $trip)
	{
		$this->system=$system;
		$this->trip=$trip;
	}
	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		if (Auth::check()){
			$isEtravelAdmin = $this->system->isAdmin;
			$forApproval= $this->trip->staffTripByStatus()->groupBy('status');
			$view->with('isEtravelAdmin', $isEtravelAdmin)->with('forApproval',$forApproval);
		}
	}
}