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

class TripController extends Controller
{
    /**
     * @brief create trip 
     */
    public function create(Request $requset) 
    {
		$userName = $requset->get('userName');
		$userProfile = User::with('costcenter', 'department', 'site')->where('UserName', $userName)
			->first()
			->toArray();
		return view('/etravel/trip/create')->with('userProfile', $userProfile);
	}
    /**
     * @brief create demostic trip
     * @param Request $requset
     * @return \Illuminate\View\View
     */
    public function demosticCreate(Request $requset) 
    {
		$departmentFilter = array ();
		$userName = $requset->get('userName');
		$userProfile = User::with('costcenter', 'department', 'site')->where('UserName', $userName)
			->first()
			->toArray();
		if (! empty($userProfile)) {
			$departmentFilter['SiteID'] = $userProfile['SiteID'];
			$departmentFilter['DepartmentID'] = $userProfile['DepartmentID'];
			$departmentFilter['CompanyID'] = $userProfile['CompanyID'];
			$approvers = Department_approver::where($departmentFilter)->first([ 
				'Approver1'
			])->toArray();
			$userIds = explode(',', $approvers['Approver1']);
			$approvers = User::whereIn('UserID', $userIds)->get()->toArray();
			$costCenters = Costcenter::where('CompanyID',Auth::user()->CompanyID)->orderBy('CostCenterCode')->get();
		}
		$purposeCategory = Trip_purpose::all(['purpose_id','purpose_catgory']);
		return view('/etravel/trip/demosticCreate')->with('userProfile', $userProfile)->with('approvers', $approvers)->with('purposeCats',$purposeCategory)->with('costCenters',$costCenters);
	}
    /**
     *@brief currently user trip info list
     */
	public function index(User $user,Request $request)
    {
		$filter = [];
   	 	$tripType= $request->input('trip_type');
   	 	if ($tripType){
   	 		$filter['trip_type']=$tripType;
   	 	}
   	 	$tripList = $user->tripList()->where($filter)->paginate(1);
//     		dd($tripList);
		// $tripList=[];
    		return view('etravel/trip/index')->with('tripList',$tripList);
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
			'purpose_cat',
			'purpose_desc',
			'travel_cost',
			'entertain_cost',
			'entertain_detail',
			'is_approved'
		]));
		$tripObjMdl = Trip::create($tripData);
		foreach ($demosticData as $item){
    			$tripObjMdl->demostic()->create($item);
    		}
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
		$demosticInfo = $trip->demostic()->get();
		return view('/etravel/trip/tripDemosticDetail', [ 
			'trip' => $trip,
			'demosticInfo' => $demosticInfo,
			'costCenterCode' => $trip->costcenter()->first()->CostCenterCode
		]);
	}
    
}