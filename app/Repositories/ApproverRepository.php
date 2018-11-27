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
		$delegatedOverseaApprover =$overseaApproverOrigin= Company_site::where('countryID',$param['countryId'])->where('SiteId',$param['siteId'])->where('CompanyId',$param['companyId'])->get(['GeneralManagerID'])->filter(function($item){
			return ($item->GeneralManagerID !== null);
		});
			// 		dd($delegatedOverseaApprover->toArray());
		$delegatedOverseaApprover = array_unique(array_pluck($delegatedOverseaApprover, 'GeneralManagerID'));
		$overseaApproverOrigin = array_unique(array_pluck($overseaApproverOrigin, 'GeneralManagerID'));
// 		dd($overseaApproverOrigin);
// 		dd($res); 
		array_walk($delegatedOverseaApprover, ['App\User','checkIsDelegate']);
// 		dd($delegatedOverseaApprover);

		self::$overseaApproverAssocOrigin = array_combine(array_diff($delegatedOverseaApprover, $overseaApproverOrigin), array_diff($overseaApproverOrigin,$delegatedOverseaApprover));
// 		dd(self::$overseaApproverAssocOrigin );
		$generalManager = User::whereIn('UserID', $delegatedOverseaApprover)->get();
		return $generalManager;
	}
	
	
}