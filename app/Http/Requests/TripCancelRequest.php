<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;

class TripCancelRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$trip = $this->route('trip');
		return Trip::where('trip_id',$trip->trip_id)->where('user_id',Auth::user()->UserID)->exists();
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
