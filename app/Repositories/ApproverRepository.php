<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Company_site;
use App\User;

class ApproverRepository extends Repository
{
	public static $overseaApproverAssocOrigin=array();
	public function model() 
	{
		return 'App\Company_site';
	}
	
	public function getGeneralManagerByCountryId($param)
	{
		$generalManager = array();
// 		dd($param);
		$delegatedOverseaApprover =$overseaApproverOrigin= Company_site::where('countryID',$param['countryId'])->where('SiteId',$param['siteId'])->where('CompanyId',$param['companyId'])->first(['GeneralManagerID']);
		if ($delegatedOverseaApprover['GeneralManagerID']){
			$delegatedOverseaApprover =$overseaApproverOrigin= explode(',', $delegatedOverseaApprover['GeneralManagerID']);
			array_walk($delegatedOverseaApprover, ['App\User','checkIsDelegate']);
			self::$overseaApproverAssocOrigin = array_combine(array_diff($delegatedOverseaApprover, $overseaApproverOrigin), array_diff($overseaApproverOrigin,$delegatedOverseaApprover));
			$generalManager = User::whereIn('UserID', $delegatedOverseaApprover)->get();
			
			$generalManager->put('createrCountryID',$param['countryId']);
		}
// 		dd($generalManager);
		return $generalManager;
	}
	
	
}