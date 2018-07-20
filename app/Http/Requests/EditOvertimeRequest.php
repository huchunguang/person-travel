<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use App\Overtime;

class EditOvertimeRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$overtime = $this->route('overtime');
		$user_id = Auth::user()->UserID;
		return Overtime::where('id', $overtime->id)->where('user_id', $user_id)->exists();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			
		];
	}

}
