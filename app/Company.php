<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	//
	protected $table='company';
	protected $primaryKey='CompanyID';
	
	public function wbscode()
	{
		return $this->hasMany('App\Wbscode','company_id','CompanyID');
	}
	public function department()
	{
		return $this->belongsToMany('App\Department','company_department','CompanyID','DepartmentID');
	}
}
