<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Department_approver;
use App\Trip;
use App\Trip_purpose;

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
		}
		$purposeCategory = Trip_purpose::all(['purpose_id','purpose_catgory']);
		return view('/etravel/trip/demosticCreate')->with('userProfile', $userProfile)->with('approvers', $approvers)->with('purposeCats',$purposeCategory);
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
    				'daterange_from'=>'required',
    				'daterange_to'=>'required',
    				'datetime_date'=>'required',
    				'datetime_time'=>'required',
    				'location'=>'required',
    				'customerName'=>'required',
    				'contactName'=>'required',
    				'purposeDesc'=>'required',
    				'department_approver'=>'required|integer'
    		];
    		$this->validate($request, $rules);
//     		$storeData = array_merge($request->all(),['user_id'=>$request->get('user_id')]);
    		$tripData=$request->only(['user_id','daterange_from','daterange_to','extra_comment','department_approver','approver_comment']);
    		$tripData=array_merge($tripData,['user_id'=>$request->get('user_id'),'trip_type'=>2]);
//     		dd($tripData);
    		Trip::create($tripData);
    		return redirect()->route('triplist',['user'=>$request->get('user_id')]);
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
		$demosticReqs = $trip->demostic()->get();
		return view('/etravel/trip/tripDemosticDetail')->with('trip', $trip)->with('demosticReqs', $demosticReqs);
	}
    
}