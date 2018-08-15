<?php
namespace App\Repositories;

use App\Repositories\Eloquent\Repository;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Country;
use PhpParser\Builder\FunctionTest;
use App\User;
use App\Trip_counter;
use Carbon\Carbon;

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
	
	public function generateRef()
	{
		$tripCounter = Trip_counter::where('year', Carbon::now()->year)->where('company_id', Auth::user()->CompanyID)->first();
		$counterNum = $tripCounter ? $tripCounter->total_number : 0;
		return auto_generate_ref($counterNum);
	}
	
	public function getCcUser(Trip $trip)
	{
		if ($trip->cc) {
			$cc = User::whereIn('Email', $trip->cc)->get();
		}
		return $cc ? $cc : [ ];
	}
	
	public function getTravelType(Trip $trip)
	{
		return Trip::$traveltype[$trip->trip_type];
	}
	
	public function getDaysToApply(Trip $trip)
	{
		$dtStart = Carbon::parse($trip->daterange_from);
		$dtEnd = Carbon::parse($trip->daterange_to);
		return $dtEnd->diffInDays($dtStart);
	}
	
	public function getUser(Trip $trip)
	{
		return $trip->user()->first()->LastName.' '.$trip->user()->first()->FirstName;
	}
	
	public function getListByStatus($status='approved') 
	{
		if (in_array($status, $this->validateStatus)){
			$res=Trip::where(['user_id'=>Auth::user()->UserID,'status'=>$status])->orderBy('daterange_from','DESC')->limit(10)->get();
			foreach ($res as $item) {
				$item->destination_name = $this->getTripDst($item);
			}
			return $res;
		}
		return [];
	}
	
	public function staffTripByStatus()
	{
		return Trip::where(['department_approver'=>Auth::user()->UserID])->orWhere(['overseas_approver'=>Auth::user()->UserID])->orderBy('created_at','DESC')->get();
	}
	
	public function getTripDst(Trip $trip)
	{
		if ($trip->trip_type == '1'){
// 			dd(Country::find($trip->destination_id,['Country'])->implode('Country',','));
			$country = Country::find($trip->destination_id,['Country']);
			if ($country){
				return $country->implode('Country',',');
			}else{
				return null;
			}
		}elseif ($trip->trip_type == '2'){
			return Trip::$traveltype[$trip->trip_type];
		}
	}
}