<?php namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use App\Http\Requests\TripCancelRequest;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Events\TripNotify;

class HrController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	
	/**
	 * @param TripCancelRequest $request
	 * @param Trip $trip
	 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	public function demosticCancel(Request $request,Trip $trip)
	{
		DB::beginTransaction();
		try {
			$user_id = Auth::user()->UserID;
			$trip->status = Trip::PENDING;
			$trip->is_approved=0;
			$trip->is_depart_approved=null;
			$trip->save();
			$trip->demostic()->update(['is_approved'=>0]);
			DB::commit();
			Event::fire(new TripNotify($trip, $request, $trip->status));
		}
		catch (Exception $e) {
			DB::rollBack();
		}
		return redirect('/etravel/tripnationallist/' . $trip->trip_id)->with('trip',$trip);
	}
	/**
	 * @param TripCancelRequest $request
	 * @param Trip $trip
	 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	public function nationalCancel(Request $request,Trip $trip)
	{
		
		$trip->status = Trip::PENDING;
		$trip->is_approved=0;
		$trip->is_depart_approved=null;
		$trip->save();
		Event::fire(new TripNotify($trip, $request, $trip->status));
		return redirect('/etravel/tripnationallist/' . $trip->trip_id)->with('trip',$trip);
		
	}
	

}
