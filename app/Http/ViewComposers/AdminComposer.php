<?php
namespace App\Http\ViewComposers;

use App\Contacts\SystemVariable;
use Illuminate\Contracts\View\View;
use App\Services\SystemInfo;
use Illuminate\Support\Facades\Auth;
use App\Company_site;

class AdminComposer
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
		$result = Company_site::where('EtravelAdminId',Auth::user()->UserID)->get(['CountryID','SiteID','CompanyID']);
		if ($result){
			$result=$result->toArray();
			$accessCountryIds=array_pluck($result, 'CountryID');
			$accessSiteIds=array_pluck($result, 'SiteID');
			$accessCompanyIds=array_pluck($result, 'CompanyID');
			
			
// 			echo '<pre>';
// 			var_dump($accessCompanyIds,$accessCountryIds,$accessSiteIds);die;
			$view->with('accessCountryIds', $accessCountryIds)->with('accessSiteIds',$accessSiteIds)->with('accessCompanyIds',$accessCompanyIds);
		}
		
	}
}