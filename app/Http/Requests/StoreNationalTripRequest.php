<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreNationalTripRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the store international travel request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'destination'=>'required|array',
			'cost_center_id'=>'required|integer',
			'daterange_from'=>'required|date',
			'daterange_to'=>'required|date|after:daterange_from',
			'department_approver'=>'required|integer',
			'overseas_approver'=>'required_if:workflow,2',
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
			'purpose_file' => 'mimes:txt,doc,xlsx,pdf,docx,xls,jpg,jpeg,png,gif,bmp,ppt,pptx',
// 			'project_code'=>'required',
			
		];
	}

}
