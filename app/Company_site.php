<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_site extends Model {

	//
	protected $primaryKey='CompanySiteID';
	
	
	public function generalManager()
	{
		return $this->hasOne('App\User','UserID','GeneralManagerID');
	}
}
