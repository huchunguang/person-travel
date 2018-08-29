<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Trip;

class EditDomesticRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$trip = $this->route('trip');
		$user_id=Auth::user()->UserID;
		return Trip::where('trip_id',$trip->trip_id)->where(function($query)use($user_id){
			$query->where(['user_id'=>$user_id])
			->orWhere(['applicant_id'=>$user_id]);
		})->exists();
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
