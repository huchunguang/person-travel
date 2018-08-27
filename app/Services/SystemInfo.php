<?php
namespace App\Services;

use App\Contacts\SystemVariable;
use Illuminate\Support\Facades\Auth;
use App\Country;
use App\Trip_announcement;
use App\Company;
use App\Company_site;
use App\User;

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
	public function getAdminEmail()
	{
		
		$etravelAdmin = Company_site::where('CompanyID',Auth::user()->CompanyID)->where('SiteID',Auth::user()->SiteID)->first();
// 		dd($etravelAdmin->toArray());
		if ($etravelAdmin){
			$result = User::find(explode(',', $etravelAdmin->EtravelAdminID));
			return isset($result)?$result:null;
		}
		return null;
	}
	public function getIsAdmin()
	{
		return Company_site::where('EtravelAdminID',Auth::user()->UserID)->exists();
	}
	public function getAccessSiteIds()
	{
		if($this->getIsAdmin()){
			$result = Company_site::where('EtravelAdminID',Auth::user()->UserID)->get(['SiteID']);
			if ($result){
				$result=$result->toArray();
				$accessSiteIds=array_unique(array_pluck($result, 'SiteID'));
			}
			return $accessSiteIds;
		}
		return [];
	}
	public function getAccessCountryIds()
	{
		if($this->getIsAdmin()){
			$result = Company_site::where('EtravelAdminID',Auth::user()->UserID)->get(['CountryID']);
			if ($result){
				$result=$result->toArray();
				$accessCountryIds=array_unique(array_pluck($result, 'CountryID'));
			}
			return $accessCountryIds;
		}
		return [];
	}
	public function getAccessCompanyIds()
	{
		if($this->getIsAdmin()){
			$result = Company_site::where('EtravelAdminId',Auth::user()->UserID)->get(['CompanyID']);
			if ($result){
				$result=$result->toArray();
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
	public function getWbscodeList()
	{
		return Company::find(Auth::user()->CompanyID)->wbscode()->orderBy('project_type','ASC')->orderBy('status','DESC')->get()?:[];
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