<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Trip_purpose;
use Illuminate\Support\Facades\Auth;

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
			'company_id'=>Auth::user()->CompanyID,
		];
		return Trip_purpose::where($filter)->get();
	}
}
