<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Company_site;

class TripReadRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$trip = $this->route('trip');
		$user_id=Auth::user()->UserID;
		$isEtravelAdmin = Company_site::whereRaw('FIND_IN_SET(?,EtravelAdminID)',[Auth::user()->UserID])->exists();
// 		$ccUser = $trip->cc;
// 		dd(Auth::user()->Email);
// 		dd($ccUser);
		return Trip::where('trip_id',$trip->trip_id)->where(function($query)use($user_id){
			$query->where(['user_id'=>$user_id])
			->orWhere(['applicant_id'=>$user_id]);
		})->orWhere('department_approver',$user_id)->orWhere(['is_depart_approved'=>'1','overseas_approver'=>$user_id])->exists() || in_array(Auth::user()->Email,$trip->cc) || $isEtravelAdmin;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
		];
	}

}
