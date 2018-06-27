<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Company_site;
use App\User;

class ApproverRepository extends Repository
{
	public function model() 
	{
		return 'App\Company_site';
	}
	
	public function getGeneralManagerByCountryId($param)
	{
		$generalManager = array();
		$res = Company_site::whereIn('countryID',$param)->get(['GeneralManagerID'])->filter(function($item){
			return ($item->GeneralManagerID !== null);
		})->unique();
		$res = array_pluck($res, 'GeneralManagerID');
		array_walk($res, ['App\User','checkIsDelegate']);
		$generalManager = User::whereIn('UserID', $res)->get();
		return $generalManager;
	}
}