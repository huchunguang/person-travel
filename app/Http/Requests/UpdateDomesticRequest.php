<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;

class UpdateDomesticRequest extends Request {

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
			'cost_center_id'=>'required',
			'daterange_from'=>'required',
			'daterange_to'=>'required|date',
			'datetime_date'=>'required|date|after:daterange_from',
			'datetime_time' => 'required',
			'location' => 'required',
			'customer_name'=>'required',
			'contact_name'=>'required',
			'purpose_desc'=>'required',
			'demostic_id'=>'required'
		];
		
	}

}
