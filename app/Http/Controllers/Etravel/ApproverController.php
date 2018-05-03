<?php namespace App\Http\Controllers\Etravel;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Events\TripWasApproved;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
use App\Events\TripWasRejected;
use App\Events\TripWasPartlyApproved;

class ApproverController extends Controller {
	
	public function __construct() 
	{
		$this->user_id=Auth::user()->UserID;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request,User $user)
	{
		$status=$request->input('status');
		$tripList = Trip::OfStatus($status)->where(['department_approver'=>$this->user_id])->paginate(PAGE_SIZE);
// 		dd($tripList);
		return view('etravel/approver/index', [
			'status'=>$status?$status:'all',
			'tripList' => $tripList,
			'breadcrumb' => 'Staff Travel Requests List'
		]);
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	public function approval(Request $request,Trip $trip) 
	{
		$status= $request->input('status');
// 		dd($request->all());
		switch ($status){
			case 'approved':
				Event::fire(new TripWasApproved($trip,$request));break;
			case 'partly-approved':
				Event::fire(new TripWasPartlyApproved($trip,$request));break;
			case 'rejected':
				Event::fire(new TripWasRejected($trip,$request));break;
				
		}
		return redirect('/etravel/tripdemosticlist/'.$trip->trip_id);
	}

}
