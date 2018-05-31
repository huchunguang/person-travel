<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;

class UpdateNationalTripRequest extends Request {

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
			'destination'=>'required|array',
			'cost_center_id'=>'required|integer',
			'daterange_from'=>'required|date',
			'daterange_to'=>'required|date',
			'department_approver'=>'required|integer',
			'approver_comment'=>'string',
			'extra_comment'=>'string',
			'is_sent_affairs'=>'boolean',
			'ticket_booker'=>'boolean',
			'flight_date'=>'array',
			'flight_from'=>'array',
			'flight_to'=>'array',
			'airline_or_train'=>'array',
			'etd_time'=>'array',
			'eta_time'=>'array',
			'class_flight'=>'array',
			'room_type'=>'string',
			'smoking'=>'integer',
			
			
		];
		
	}

}
