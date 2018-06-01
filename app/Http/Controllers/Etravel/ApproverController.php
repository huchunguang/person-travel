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
use App\Repositories\ApproverRepository;
use App\Events\TripNotify;

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
		$tripList = Trip::OfStatus($status)->where(['department_approver'=>$this->user_id])->orWhere(function($query){
			$query->where(['overseas_approver'=>$this->user_id])
			->where(['is_depart_approved'=>'1']);
		})->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
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
		$trip->update(['approver_comment'=>$request->input('approver_comment')]);
// 		dd($request->all());
		switch ($status){
			case 'approved':
				Event::fire(new TripWasApproved($trip,$request));break;
			case 'partly-approved':
				Event::fire(new TripWasPartlyApproved($trip,$request));break;
			case 'rejected':
				Event::fire(new TripWasRejected($trip,$request));break;
				
		}
		
		if ($trip->trip_type=='2'){
			Event::fire(new TripNotify($trip, $request, 'Domestic Trip '.$status));
			return redirect('/etravel/tripdemosticlist/'.$trip->trip_id);
		}elseif ($trip->trip_type=='1'){
			Event::fire(new TripNotify($trip, $request, 'National Trip '.$status));
			return redirect('/etravel/tripnationallist/'.$trip->trip_id);
		}
		
	}
	public function getOverseasApprover(Request $request,ApproverRepository $approver)
	{
		$countryId=$request->input('countryId');
		if ($countryId){
			$countryId=explode(',', $countryId);
			$generalManager=$approver->getGeneralManagerByCountryId($countryId);
			return response()->json($generalManager);
		}
	}

}
