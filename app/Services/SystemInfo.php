<?php
namespace App\Services;

use App\Contacts\SystemVariable;
use Illuminate\Support\Facades\Auth;
use App\Country;
use App\Trip_announcement;
use App\Company;

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