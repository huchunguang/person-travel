<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model {

	protected $fillable = ['user_id'];
	
	public function accomodation() 
	{
		return $this->hasMany('App\Trip_accomodation','trip_id','trip_id');
	}
	public function demostic() 
	{
		return $this->hasMany('App\Trip_demostic','trip_id','trip_id');
	}
	public function estimateExpense() 
	{
		return $this->hasMany('App\Trip_estimate_expense','trip_id','trip_id');
	}
	public function flight() 
	{
		return $this->hasMany('App\Trip_flight','trip_id','trip_id');
	}
	
}
