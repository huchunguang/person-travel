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
use Carbon\Carbon;
use App\Trip_demostic;

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
   	 	$tripList = $user->tripList()->where($filter)->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
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
		$purposeCategory = Trip_purpose::all(['purpose_id','purpose_catgory']);
// 		dd($demosticInfo->toArray());
// 		foreach ($demosticInfo as $item){
// 			echo $item->visitPurpose()->first()['purpose_catgory'];
// 		}
// 		die;
		return view('/etravel/trip/demosticEdit', [
			'userObjMdl'=>$userObjMdl,
			'trip' => $trip,
			'purposeCats'=>$purposeCategory,
			'approver'=>$approver,
			'demosticInfo' => $demosticInfo,
			'costCenterCode' => $trip->costcenter()->first()->CostCenterCode,
			'costCenters'=>Costcenter::getAvailableCenters(),
		]);
	}
	/**
	 * @desc store demostic update data by it owner creater(Resubmit)
	 * @param Trip $trip
	 * @param Request $request
	 */
	public function demosticUpdate(Trip $trip,Request $request) 
	{
		$rules=[
			'cost_center_id'=>'required',
			'daterange_from'=>'required',
			'daterange_to'=>'required',
			'datetime_date'=>'required',
			'datetime_time' => 'required',
			'location' => 'required',
			'customer_name'=>'required',
			'contact_name'=>'required',
			'purpose_desc'=>'required',
			'demostic_id'=>'required'
		];
		$this->validate($request, $rules);
		$demostic_data=array_bound_key($request->only([
			'demostic_id',
			'datetime_date',
			'datetime_time',
			'location',
			'customer_name',
			'contact_name',
			'purpose_desc',
			'travel_cost',
			'entertain_cost',
			'entertain_detail',
			
		]));
// 		dd($demostic_data);
		DB::transaction(function()use($trip,$request,$demostic_data){
			$trip->status=($request->input('status')=='partly-approved')?'pending':$request->input('status');
			$trip->cost_center_id=$request->input('cost_center_id');
			$trip->daterange_from=$request->input('daterange_from');
			$trip->daterange_to=$request->input('daterange_to');
			$trip->save();
			foreach ($demostic_data as $item){
				$demostic_trip = Trip_demostic::find($item['demostic_id']);
				$demostic_trip->datetime_date=$item['datetime_date'];
				$demostic_trip->datetime_time=$item['datetime_time'];
				$demostic_trip->location=$item['location'];
				$demostic_trip->customer_name=$item['customer_name'];
				$demostic_trip->contact_name=$item['contact_name'];
				$demostic_trip->purpose_desc=$item['purpose_desc'];
				$demostic_trip->travel_cost=number_format($item['travel_cost'],2);
				$demostic_trip->entertain_cost=number_format($item['entertain_cost'],2);
				$demostic_trip->entertain_detail=$item['entertain_detail'];
				$demostic_trip->save();
			}
		});
		$user_id=Auth::user()->UserID;
		return redirect('/etravel/'.$user_id.'/triplist?status=pending');
// 		dd($request->all());
	}
	public function demosticCancel(Trip $trip,Request $request) 
	{
		$user_id=Auth::user()->UserID;
		$trip->status='cancelled';
		$trip->save();
		return redirect('/etravel/'.$user_id.'/triplist?status=pending');
	}
}