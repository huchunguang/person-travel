<?php
namespace App\Http\ViewComposers;

use App\Contacts\SystemVariable;
use Illuminate\Contracts\View\View;
use App\Services\SystemInfo;
use Illuminate\Support\Facades\Auth;

class CommonComposer
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
		$view->with('wbscodeList', $this->system->wbscodeList)
			->with('currencyList',$this->system->currencyList)
			->with('defaultCostCenterID', $this->system->defaultCostCenterID)
			->with('CountryAssignedID',$this->system->CountryAssignedID)
			->with('SiteID',$this->system->SiteID)
			->with('currentUser',Auth::user())
			->with('CompanyID',$this->system->CompanyID);
	}
}