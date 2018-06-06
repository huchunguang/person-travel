<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Company_site;

class ApproverRepository extends Repository
{
	public function model() 
	{
		return 'App\Company_site';
	}
	public function getGeneralManagerByCountryId($param)
	{
		$generalManager=array();
		$res=Company_site::whereIn('countryID',$param)->get();
		foreach ($res as $item)
		{
			$generalManager[]=$item->generalManager()->first();
		}
		$generalManager=array_unique(array_filter($generalManager));
		return $generalManager;
	}
}