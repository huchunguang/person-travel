<?php
namespace App\Services;

use App\Contacts\SystemVariable;
use Illuminate\Support\Facades\Auth;
use App\Country;
use App\Trip_announcement;
use App\Company;
use App\Company_site;
use App\User;
use App\Trip;
use App\Currencys;

class SystemInfo implements SystemVariable{
	public $user_id='';
	public function __construct() 
	{
		if (Auth::check()){
			$this->user_id=Auth::user()->UserID;
		}
	}
	/**
	 * {@inheritDoc}
	 * @see \App\Contacts\SystemVariable::getCountry()
	 */
	public function getCountry()
	{
		
		return Country::find(Auth::user()->CountryAssignedID,['Country']);
	}

	/**
	 * {@inheritDoc}
	 * @see \App\Contacts\SystemVariable::getSiteId()
	 */
	public function getSiteId()
	{
		return Auth::user()->SiteID;
		
	}
	public function getCountryId()
	{
		return Auth::user()->CountryAssignedID;
	}
	public function getCurrencyList()
	{
		return Currencys::all();
	}
	public function getAdminEmail($trip=null)
	{
		$user=$trip?User::find($trip->user_id):Auth::user();
		$etravelAdmin = Company_site::where('CompanyID',$user->CompanyID)->where('SiteID',$user->SiteID)->first();
// 		dd($etravelAdmin->toArray());
		if ($etravelAdmin){
			$result = User::find(explode(',', $etravelAdmin->EtravelAdminID));
			return isset($result)?$result:null;
		}
		return null;
	}
	public function getIsAdmin()
	{
		return \DB::table('company_sites')->whereRaw('FIND_IN_SET('.Auth::user()->UserID.',EtravelAdminID)')
		->exists();
// 		return Company_site::whereIn('EtravelAdminID',[Auth::user()->UserID])->exists();
	}
	public function getAccessSiteIds()
	{
		if($this->getIsAdmin()){
			$result = \DB::table('company_sites')->whereRaw('FIND_IN_SET('.Auth::user()->UserID.',EtravelAdminID)')->get(['SiteID']);
// 			dd(Auth::user()->UserID);
			if ($result){
// 				$result=$result->toArray();
				$accessSiteIds=array_unique(array_pluck($result, 'SiteID'));
			}
// 			var_dump($accessSiteIds);die;
			return $accessSiteIds;
		}
		return [];
	}
	public function getAccessCountryIds()
	{
		if($this->getIsAdmin()){
			$result = \DB::table('company_sites')->whereRaw('FIND_IN_SET('.Auth::user()->UserID.',EtravelAdminID)')->get(['CountryID']);
			if ($result){
// 				$result=$result->toArray();
				$accessCountryIds=array_unique(array_pluck($result, 'CountryID'));
			}
			return $accessCountryIds;
		}
		return [];
	}
	public function getAccessCompanyIds()
	{
		if($this->getIsAdmin()){
			$result = \DB::table('company_sites')->whereRaw('FIND_IN_SET('.Auth::user()->UserID.',EtravelAdminID)')->get(['CompanyID']);
			if ($result){
// 				$result=$result->toArray();
				$accessCompanyIds=array_unique(array_pluck($result, 'CompanyID'));
			}
			return $accessCompanyIds;
		}
		return [];
	}
	public function getDefaultCostCenterID()
	{
		return Auth::user()->DefaultCostCenterID;
	}
	public function getAnnouncement ()
	{
		$curDate=date('m/d/Y',time());
		return Trip_announcement::with('announceType')->where('site_id',$this->getSiteId())->where('date_effectivity','<=',$curDate)->where('date_expired','>=',$curDate)->first();
	}
	public function getWbscodeList($company_id=null)
	{
		$company_id = $company_id?$company_id:Auth::user()->CompanyID;
		return Company::find($company_id)->wbscode()->orderBy('project_type','ASC')->orderBy('status','DESC')->get()?:[];
	} 
	
	public function __get($name)
	{
		
		$method_name = 'get' . ucfirst($name);
		if (method_exists($this, $method_name))
		{
			return $this->$method_name();
		}
		if (property_exists($this, $name))
		{
			return $this->name;
		}
		if (Auth::user()->$name!==null)
		{
			return Auth::user()->$name;
		}
		return null;
		
	}
	
}