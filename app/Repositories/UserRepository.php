<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Trip_purpose;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Company_site;

class UserRepository extends Repository
{
	public function model() 
	{
		return 'App\User';
	}
	
	public function purposeCatWithCompany() 
	{
		$filter=[
			'site_id'=>Auth::user()->SiteID,
			'company_id'=>Auth::user()->CompanyID
		];
		return Trip_purpose::where($filter)->get();
	}

	public function getHrList()
	{
		$hrUserList = array();
		$res = DB::select('SELECT * FROM tbl_hr_access  where find_in_set(:site_id,`SiteIDs`) and find_in_set(:company_id,`CompanyIDs`) and `HRRoleID`=1;',$filter=[
			'site_id'=>Auth::user()->SiteID,
			'company_id'=>Auth::user()->CompanyID
		]);
		$hrIds = array_pluck($res, 'HRID');
		$hrUserList = User::whereIn('UserID',$hrIds)->get();
// 		dd($hrUserList->toArray());
		return $hrUserList;
	}
	public function getWorkflowCfg(User $user=null)
	{
		$user = $user?$user:Auth::user();
		$res = Company_site::where('CompanyID',$user->CompanyID)->where('SiteID',$user->SiteID)->where('CountryID',$user->CountryAssignedID)->first();
		return $res;
	}
}
