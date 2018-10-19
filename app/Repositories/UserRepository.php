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
	
	public function purposeCatWithCompany($user=null) 
	{
		$user = $user?$user:Auth::user();
		$filter=[
			'site_id'=>$user->SiteID,
			'company_id'=>$user->CompanyID
		];
		return Trip_purpose::where($filter)->get();
	}

	public function getHrList($columns=['*'])
	{
		$hrUserList = array();
// 		dd(Auth::user()->SiteID);
		$res = DB::select('SELECT * FROM tbl_hr_access  where find_in_set(:site_id,`SiteIDs`) and `HRRoleID`=1;',$filter=[
			'site_id'=>Auth::user()->SiteID,
		]);
// 		dd($res);
		$hrIds = array_pluck($res, 'HRID');
		$hrUserList = User::whereIn('UserID',$hrIds)->get($columns);
// 		dd($hrUserList->toArray());
		return $hrUserList;
	}
	public function getWorkflowCfg(User $user=null)
	{
		$user = $user?$user:Auth::user();
		$res = Company_site::where('CompanyID',$user->CompanyID)->where('SiteID',$user->SiteID)->where('CountryID',$user->CountryAssignedID)->first();
		return $res;
	}
	public function isOverseasApprover(User $user=null)
	{
		$user = $user?$user:Auth::user();
		$res=Company_site::where('GeneralManagerID',$user->UserID)->exists();
		return $res;
	}
}
