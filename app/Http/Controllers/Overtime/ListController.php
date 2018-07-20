<?php namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ListController extends Controller {

	public function index(Request $request) 
	{
		$status=$request->input('status','pending');
		return view('/overtime/list/index',compact('status'));
	}
}
