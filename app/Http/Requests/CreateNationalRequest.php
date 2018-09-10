<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Country;

class CreateNationalRequest extends Request {

	/**
	 * Determine if the user is authorized to create international travel  .
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$cnId = Country::where('Country', 'China')->first()->CountryID;
		if (Auth::user()->CountryAssignedID == $cnId && Auth::user()->DepartmentID!='123') {
			$this->session()->flash('requestError', 'ETravel is not applicable for Chinese Users');
// 			dd(session('requestError'));
			return false;
		}
		return true;
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
