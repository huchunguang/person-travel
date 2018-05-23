<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Country;
use PhpParser\Builder\FunctionTest;
use App\User;

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
		return 'App\Trip';
	}	
	public function getCcUser(Trip $trip){
		if ($trip->cc){
			$cc = User::whereIn('Email',$trip->cc)->get();
			
		}
		return $cc?$cc:[];
	}
	public function getListByStatus($status='approved') 
	{
		if (in_array($status, $this->validateStatus)){
			return Trip::where(['user_id'=>Auth::user()->UserID,'status'=>$status])->orderBy('updated_at','DESC')->limit(5)->get();
		}
		return [];
	}
	public function staffTripByStatus()
	{
		return Trip::where(['department_approver'=>Auth::user()->UserID])->orderBy('created_at','DESC')->get();
	}
	public function getTripDst(Trip $trip)
	{
		if ($trip->trip_type == '1'){
// 			dd(Country::find($trip->destination_id,['Country'])->implode('Country',','));
			return Country::find($trip->destination_id,['Country'])->implode('Country',',');
		}
		if ($trip->trip_type == '2'){
			return 'domestic';
		}
	}
}