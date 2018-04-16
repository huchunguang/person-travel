<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Department_approver;
use App\Trip;

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
		return view('/etravel/trip/demosticCreate')->with('userProfile', $userProfile)->with('approvers', $approvers);
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
    public function store(Request $request) 
    {
    		$tripType = $request->input('tripType');
    		if ($tripType=='demostic'){
    			$rules=[];
    		}elseif ($tripType=='national'){
    			$rules=[
    				'title' => 'required|max:255|min:4',
    				'content' => 'required|min:20',
    			];
    		}
    		$this->validate(request(), $rules);
    		$storeData = array_merge(request(),$request->get('user_id'));
    		Trip::create($storeData);
    		return redirect()->route('triplist',['user'=>$request->get('user_id')]);
    }
    public function tripDetails(Request $request,Trip $trip)
    {
    		$tripType=1;
    		$tripType=$request->input('tripType');
    		
    		if ($tripType===1){
    			$accomodationInfo = $trip->accomodation()->get();
    			$estimateExpense = $trip->estimateExpense()->get();
    			$flighInfo = $trip->flight()->get();
			return view('')->with('accomodationInfo', $accomodationInfo)
				->with('estimateExpense', $estimateExpense)
				->with('flighInfo', $flighInfo)
				->with('tripBasicInfo', $trip);
    		}elseif ($tripType===2){
    			$demosticReqs = $trip->demostic()->get();
    			return view('')->with('trip',$trip)->with('demosticReqs',$demosticReqs);
    		}
    }	
    
}