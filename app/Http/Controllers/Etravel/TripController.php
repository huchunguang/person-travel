<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Department_approver;
use App\Trip;
use App\Trip_purpose;
use Illuminate\Support\Facades\Auth;
use App\Costcenter;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * @brief create trip 
     */
    public function create(Request $requset) 
    {
    		$userProfile=User::getUserProfile();
    		$purposeCategory = Trip_purpose::all(['purpose_id','purpose_catgory']);
    		return view('/etravel/trip/create')->with('userProfile', $userProfile['userProfile'])->with('approvers', $userProfile['approvers'])->with('purposeCats',$purposeCategory)->with('costCenters',Costcenter::getAvailableCenters());
	}
    /**
     * @brief create demostic trip
     * @param Request $requset
     * @return \Illuminate\View\View
     */
    public function demosticCreate() 
    {
    		$userProfile=User::getUserProfile();
		$purposeCategory = Trip_purpose::all(['purpose_id','purpose_catgory']);
		return view('/etravel/trip/demosticCreate')->with('userProfile', $userProfile['userProfile'])->with('approvers', $userProfile['approvers'])->with('purposeCats',$purposeCategory)->with('costCenters',Costcenter::getAvailableCenters());
	}
    /**
     *@brief currently user demostic trip list
     */
	public function index(User $user,Request $request)
    {
		$filter = [ ];
		$status=$request->input('status');
   	 	if ($status){
   	 		$filter['status']=$status;
   	 	}
   	 	$tripList = $user->tripList()->where($filter)->paginate(3);
		return view('etravel/trip/index', [ 
			'status'=>$status?$status:'all',
			'tripList' => $tripList,
			'breadcrumb' => 'Demostic Travel Requests List'
		]);
    }
    /**
     * @desc trip_type 1:international 2:demostic
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) 
    {
    		$rules=[
    				'cost_center_id'=>'required',
    				'daterange_from'=>'required',
    				'daterange_to'=>'required',
    				'datetime_date'=>'required',
    				'datetime_time'=>'required',
    				'location'=>'required',
    				'customer_name'=>'required',
    				'contact_name'=>'required',
    				'purpose_desc'=>'required',
    				'department_approver'=>'required|integer'
    		];
    		$this->validate($request, $rules);
    		$tripData=$request->only(['cost_center_id','daterange_from','daterange_to','extra_comment','department_approver','approver_comment']);
		$tripData = array_merge($tripData, [ 
			
			'user_id' => Auth::user()->UserID,
			'trip_type' => 2
		]);
		$demosticData = array_bound_key($request->only([ 
			
			'datetime_date',
			'datetime_time',
			'location',
			'customer_name',
			'contact_name',
			'purpose_id',
			'purpose_desc',
			'travel_cost',
			'entertain_cost',
			'entertain_detail',
			'is_approved'
		]));
		DB::transaction(function()use($tripData,$demosticData){
			$tripObjMdl = Trip::create($tripData);
			foreach ($demosticData as $item){
				$tripObjMdl->demostic()->create($item);
			}
		});
		
    		return redirect()->route('triplist',['user'=>Auth::user()->UserID]);
    }
    /**
     * @desc show the international travel pageinfo
     * @param Request $request
     * @param Trip $trip
     * @return \Illuminate\View\View
     */
    public function tripDetails(Request $request,Trip $trip)
    {
		$accomodationInfo = $trip->accomodation()->get();
		$estimateExpense = $trip->estimateExpense()->get();
		$flighInfo = $trip->flight()->get();
		return view('/etravel/trip/tripDetail')->with('accomodationInfo', $accomodationInfo)
			->with('estimateExpense', $estimateExpense)
			->with('flighInfo', $flighInfo)
			->with('tripBasicInfo', $trip);
	}

	/**
	 * @desc show the demostic travel pageinfo
	 * @param Request $request
	 * @param Trip $trip
	 * @return \Illuminate\View\View
	 */
	public function tripDemosticDetails(Request $request, Trip $trip)
    {
		$userObjMdl = User::where('UserID',$trip->user_id)->firstOrFail();
		$approver = User::find($trip->department_approver);
		$demosticInfo = $trip->demostic()->get();
		return view('/etravel/trip/tripDemosticDetail', [
			'userObjMdl'=>$userObjMdl,
			'trip' => $trip,
			'approver'=>$approver,
			'demosticInfo' => $demosticInfo,
			'costCenterCode' => $trip->costcenter()->first()->CostCenterCode
		]);
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Trip $trip)
	{
		
	}
	
	public function demosticEdit(Trip $trip,Request $request)
	{
		$userObjMdl = User::where('UserID',$trip->user_id)->firstOrFail();
		$approver = User::find($trip->department_approver);
		$demosticInfo = $trip->demostic()->get();
		return view('/etravel/trip/demosticEdit', [
			'userObjMdl'=>$userObjMdl,
			'trip' => $trip,
			'approver'=>$approver,
			'demosticInfo' => $demosticInfo,
			'costCenterCode' => $trip->costcenter()->first()->CostCenterCode
		]);
	}
}