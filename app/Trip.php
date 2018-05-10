<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model {

	protected $primaryKey = 'trip_id';
	protected $guarded= [''];
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
	public function costcenter() 
	{
		return $this->hasOne('App\Costcenter','CostCenterID','cost_center_id'); 
	}
	public function insurance() 
	{
		return $this->hasMany('App\Trip_insurance','trip_id','trip_id');
	}
	public function wbsCode() 
	{
		return $this->hasOne('App\Wbscode','wbs_id','project_code');
	}
	public function user()
	{
		return $this->belongsTo('App\User','user_id','UserID');
	}
	/**
	 * @desc query  with  different itinerary status trip  currently user 
	 * @param unknown $query
	 * @param unknown $param
	 */
	public function scopeOfStatus($query,$param) 
	{
		if (empty($param)) return $query;
		return $query->where('status',$param);
	}
	public function setFlightItineraryPreferAttribute($value) 
	{
		
		$this->attributes['flight_itinerary_prefer']=json_encode($value);
	}
	public function setHotelPreferAttribute($value) 
	{
		$this->attributes['hotel_prefer']=json_encode($value);
	}
	public function setDestinationId($value)
	{
		$this->attributes['destination_id']=json_encode($value);
	}
	public function getFlightItineraryPreferAttribute($value)
	{
		return json_decode($value,true);
	}
	public function getHotelPreferAttribute($value) 
	{
		return json_decode($value,true);
	}
	public function getDestinationId($value)
	{
		return json_decode($value,true);
	}
}
