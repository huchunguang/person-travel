<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Costcenter extends Model {

    protected $table = 'costcenter';
    protected $primaryKey='CostCenterID';
    
	public static function getAvailableCenters($company_id=null) 
	{
		return static::where('CompanyID',$company_id?$company_id:Auth::user()->CompanyID)->orderBy('CostCenterCode')->get();
	}
}
