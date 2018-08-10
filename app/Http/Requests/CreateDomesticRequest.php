<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Country;

class CreateDomesticRequest extends Request
{

	/**
	 * Determine if the user is authorized to create domestic travel.
	 * 
	 * @return bool
	 */
	public function authorize()
	{
		$cnId = Country::where('Country', 'China')->first()->CountryID;
		if (Auth::user()->CountryAssignedID == $cnId) {
			$this->session()->flash('requestError', 'ETravel is not applicable for Chinese Users');
			// dd(session('requestError'));
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
		return [			//
		];
	}
}
