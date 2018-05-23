<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;

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
		return Trip::where('trip_id',$trip->trip_id)->where('user_id',$user_id)->orWhere('department_approver',$user_id)->orWhere(['is_depart_approved'=>'1','overseas_approver'=>$user_id])->exists();
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
