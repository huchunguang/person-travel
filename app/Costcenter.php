<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Costcenter extends Model {

    protected $table = 'costcenter';
    protected $primaryKey='CostCenterID';
    
	public static function getAvailableCenters() 
	{
		return static::where('CompanyID',Auth::user()->CompanyID)->orderBy('CostCenterCode')->get();
	}
}
