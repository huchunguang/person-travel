<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Country;

class TripRepository extends Repository
{
	protected $validateStatus=array(
		'pending',
		'approved',
		'cancelled',
		'partly-approved',
		'rejected'
	);
	
	public function model() 
	{
		return Trip::class;
	}	
	
	public function getListByStatus($status='approved') 
	{
		if (in_array($status, $this->validateStatus)){
			return Trip::where(['user_id'=>Auth::user()->UserID,'status'=>$status])->orderBy('updated_at','DESC')->limit(PAGE_SIZE)->get();
		}
		return [];
	}
	public function getTripDst(Trip $trip)
	{
		if ($trip->trip_type == '1'){
			return Country::find($trip->destination_id,['Country']);
		}
		if ($trip->trip_type == '2'){
			return '';
		}
	}
}