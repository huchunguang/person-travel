<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreDomesticRequest extends Request {

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
	 * Get the validation rules that apply to the domestic travel request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'cost_center_id' => 'required',
			'daterange_from' => 'required|date',
			'daterange_to' => 'required|date|after:daterange_from',
			'datetime_date' => 'required',
			'datetime_time' => 'required',
			'location' => 'required',
			'customer_name' => 'required',
			'contact_name' => 'required',
			'purpose_desc' => 'required',
			'department_approver' => 'required|integer',
// 			'project_code' => 'required',
			
		];
	}

}
