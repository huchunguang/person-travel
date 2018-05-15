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
use App\Country;
use App\Http\Requests\StoreNationalTripRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateNationalTripRequest;
use App\Trip_flight;
use App\Trip_accomodation;
use App\Trip_estimate_expense;
use App\Http\Requests\UpdateDomesticRequest;
use App\Http\Requests\EditDomesticRequest;
use App\Http\Requests\EditNationalRequest;
use App\Http\Requests\TripCancelRequest;
use App\Http\Requests\TripReadRequest;
use App\Trip_insurance;
use App\Company;
use App\Contacts\SystemVariable;
use App\Airline;

class TripController extends Controller
{
	public function __construct(SystemVariable $system) 
	{
		$this->system=$system;
	}
    /**
     * @brief create trip 
     */
    public function create(Request $requset) 
    {
    		$userProfile=User::getUserProfile();
    		$countryList = Country::orderBy('Country')->select(['CountryID','Country','RegionID'])->get();
    		$purposeCategory = Trip_purpose::all(['purpose_id','purpose_catgory']);
    		$airlineList = Airline::all();
    		return view('/etravel/trip/create')->with('userProfile', $userProfile['userProfile'])
			->with('approvers', $userProfile['approvers'])
			->with('purposeCats', $purposeCategory)
			->with('costCenters', Costcenter::getAvailableCenters())
			->with('countryList',$countryList)
			->with('approvers', $userProfile['approvers'])
    		->with('airlineList',$airlineList);
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
			'breadcrumb' => 'Travel Requests List'
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
    				'department_approver'=>'required|integer',
    				'project_code'=>'required',
    		];
    		$this->validate($request, $rules);
		$tripData = $request->only([ 
			
			'cost_center_id',
			'daterange_from',
			'daterange_to',
			'extra_comment',
			'department_approver',
			'approver_comment',
			'project_code'
		]);
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
     * @desc store international Travel  info data into db and  upload file savepath
     * @param StoreNationalTripRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNational(StoreNationalTripRequest $request) 
    {
//     		header("Content-Type: ".Storage::mimeType($savePath));
//     		echo Storage::get($savePath);
		dd($request->all());
    		DB::beginTransaction();
    		try {
    			$trip=new Trip;
    			$trip->user_id=Auth::user()->UserID;
    			$trip->project_code=$request->input('project_code');
    			$trip->destination_id=$request->input('destination');
    			$trip->cost_center_id=$request->input('cost_center_id');
    			$trip->daterange_from=$request->input('daterange_from');
    			$trip->daterange_to=$request->input('daterange_to');
    			$trip->overseas_approver=$request->input('overseas_approver');
    			$trip->department_approver=$request->input('department_approver');
    			$trip->approver_comment=$request->input('approver_comment');
    			$trip->extra_comment=$request->input('extra_comment');
    			if ($request->hasFile('purpose_file')){
    				$file=$request->file('purpose_file');
    				if(!$file->isValid()){
    					exit('file upload occur errors');
    				}
    				$savePath = $newFileName = md5(time().rand(0,10000)).'.'.$file->getClientOriginalExtension();
    				$bytes = Storage::put(
    					$savePath,
    					file_get_contents($file->getRealPath())
    					);
    				if(!Storage::exists($savePath)){
    					exit('save upload file failure');
    				}
    				$trip->purpose_file=$savePath;
    			}
    			$trip->flight_itinerary_prefer=$request->only(['is_sent_affairs','CC']);
    			$trip->hotel_prefer=$request->only(['rep_office','room_type','smoking','foods']);
    			$trip->save();
    			$flightData=$request->only(['flight_date','flight_from','flight_to','airline_or_train','etd_time','eta_time','class_flight','is_visa']);
    			$flightData=array_bound_key($flightData);
    			$hotelData=$request->only(['hotel_name','checkin_date','checkout_date','rate']);
    			$hotelData=array_bound_key($hotelData);
    			$estimateExpenses=$request->only(['estimate_type','employee_annual_budget','employee_ytd_expenses','available_amount','required_amount']);
    			$estimateExpenses=array_bound_key($estimateExpenses);
    			$insuranceData=$request->only(['insurance_type','nominee_name','passport_fullname','nric_no','nric_num','elationship']);
    			
    			foreach ($flightData as $flightItem)
    			{
    				$trip->flight()->create($flightItem);
    			}
    			foreach ($hotelData as $hotelItem)
    			{
    				$trip->accomodation()->create($hotelItem);
    			}
    			foreach ($estimateExpenses as $estimateItem)
    			{
    				$trip->estimateExpense()->create($estimateItem);
    			}
    			if($insuranceData){
    				$trip->insurance()->create($insuranceData);
    			}
    			DB::commit();
    			return redirect()->route('triplist',['user'=>Auth::user()->UserID]);
    		} catch (Exception $e) {
    			DB::rollBack();
    		}
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
	public function tripDemosticDetails(TripReadRequest $request, Trip $trip)
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
	 * @param Request $request
	 * @param Trip $trip
	 * @return \Illuminate\View\View
	 */
	public function tripNationalDetails(TripReadRequest $request,Trip $trip) 
	{
		$overseas_approver=[];
		$userObjMdl = User::where('UserID',$trip->user_id)->firstOrFail();
		if ($trip->overseas_approver){
			$overseas_approver=User::find($trip->overseas_approver);
		}
		$approver = User::find($trip->department_approver);
		$hotelData=$trip->accomodation()->get();
		$estimateExpenses=$trip->estimateExpense()->get();
		$flightData=$trip->flight()->get();
		$insuranceData=$trip->insurance()->first();
// 		dd($trip->destination_id);
		$destination=Country::whereIn('CountryID',$trip->destination_id)->get();
// 		dd($destination->toArray());
// 		dd($trip->purpose_file);
// 		dd($destination);
		return view('/etravel/trip/tripNationalDetail', [
			'userObjMdl'=>$userObjMdl,
			'trip' => $trip,
			'approver'=>$approver,
			'overseas_approver'=>$overseas_approver,
			'hotelData' => $hotelData,
			'estimateExpenses'=>$estimateExpenses,
			'flightData'=>$flightData,
			'insuranceData'=>$insuranceData,
			'destination'=>$destination,
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
	
	public function demosticEdit(EditDomesticRequest $request,Trip $trip)
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
	public function nationalEdit(EditNationalRequest $request,Trip $trip)
	{
		$userProfile=User::getUserProfile();
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$purposeCategory = Trip_purpose::all(['purpose_id','purpose_catgory']);
		if ($trip->overseas_approver){
			$overseas_approver=User::find($trip->overseas_approver);
		}
		$approver = User::find($trip->department_approver);
		$hotelData=$trip->accomodation()->get();
		$estimateExpenses=$trip->estimateExpense()->get();
		$flightData=$trip->flight()->get();
		$insuranceData=$trip->insurance()->first();
// 		dd($insuranceData);
		$destination=Country::find($trip->destination_id);
// 		dd($estimateExpenses->toArray());
		return view('/etravel/trip/nationalEdit',[
			'userObjMdl'=>$userProfile['userProfile'],
			'overseas_approver'=>$overseas_approver,
			'approvers'=>$userProfile['approvers'],
			'purposeCats'=>$purposeCategory,
			'costCenters'=>Costcenter::getAvailableCenters(),
			'countryList'=>$countryList,
			'approvers'=>$userProfile['approvers'],
			'approver'=>$approver,
			'hotelData'=>$hotelData,
			'estimateExpenses'=>$estimateExpenses,
			'flightData'=>$flightData,
			'insuranceData'=>$insuranceData,
			'destination'=>$destination,
			'trip'=>$trip,
			'costCenterCode' => $trip->costcenter()->first()->CostCenterCode
		]);
	}
	/**
	 * @desc store demostic update data by it owner creater(Resubmit)
	 * @param Trip $trip
	 * @param Request $request
	 */
	public function demosticUpdate(UpdateDomesticRequest $request,Trip $trip) 
	{
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
				if (!empty($item['demostic_id'])) {
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
				}else{
					$trip->demostic()->create($item);
				}
				
			}
		});
		$user_id=Auth::user()->UserID;
		return redirect('/etravel/'.$user_id.'/triplist?status=pending');
// 		dd($request->all());
	}
	/**
	 * @desc store demostic update data by it owner creater(Resubmit)
	 * @param UpdateNationalTripRequest $request
	 * @param Trip $trip
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function nationalUpdate(UpdateNationalTripRequest $request,Trip $trip)
	{
// 		dd($request->all());
		DB::beginTransaction();
		try {
			$trip->user_id=Auth::user()->UserID;
			$trip->destination_id=$request->input('destination');
			$trip->cost_center_id=$request->input('cost_center_id');
			$trip->daterange_from=$request->input('daterange_from');
			$trip->daterange_to=$request->input('daterange_to');
			$trip->department_approver=$request->input('department_approver');
			$trip->approver_comment=$request->input('approver_comment');
			$trip->extra_comment=$request->input('extra_comment');
			if($request->hasFile('purpose_file')){
				$file=$request->file('purpose_file');
				if(!$file->isValid()){
					exit('file upload occur errors');
				}
				$savePath = $newFileName = md5(time().rand(0,10000)).'.'.$file->getClientOriginalExtension();
				$bytes = Storage::put(
					$savePath,
					file_get_contents($file->getRealPath())
					);
				if(!Storage::exists($savePath)){
					exit('save upload file failure');
				}
				$trip->purpose_file=$savePath;
			} 
			$trip->flight_itinerary_prefer=$request->only(['is_sent_affairs','CC']);
			$trip->hotel_prefer=$request->only(['rep_office','room_type','smoking','foods']);
			$trip->save();
			$flightData=$request->only(['flight_id','flight_date','flight_from','flight_to','airline_or_train','etd_time','eta_time','class_flight','is_visa']);
			$flightData=array_bound_key($flightData);
// 			dd($flightData);
			$hotelData=$request->only(['hotel_id','hotel_name','checkin_date','checkout_date','rate']);
// 			dd($hotelData);
			$hotelData=array_bound_key($hotelData);
// 			dd($hotelData);
			$estimateExpenses=$request->only(['estimate_id','estimate_type','employee_annual_budget','employee_ytd_expenses','available_amount','required_amount']);
			$estimateExpenses=array_bound_key($estimateExpenses);
			$insuranceData=$request->only(['insurance_id','insurance_type','nominee_name','passport_fullname','nric_no','nric_num','elationship']);
// 			dd($estimateExpenses);
			foreach ($flightData as $flightItem)
			{
				if (!empty($flightItem['flight_id'])){
					Trip_flight::find($flightItem['flight_id'])->update(array_except($flightItem, ['flight_id']));

				}else{
					$trip->flight()->create($flightItem);
				}
				
			}
			foreach ($hotelData as $hotelItem)
			{
				if (!empty($hotelItem['hotel_id'])) {
					Trip_accomodation::find($hotelItem['hotel_id'])->update(array_except($hotelItem, ['hotel_id']));
				}else{
					$trip->accomodation()->create($hotelItem);
				}
			}
			foreach ($estimateExpenses as $estimateItem)
			{
				if (!empty($estimateItem['estimate_id'])){
					Trip_estimate_expense::find($estimateItem['estimate_id'])->update(array_except($estimateItem, ['estimate_id']));
				}else{
					$trip->estimateExpense()->create($estimateItem);
				}
			}
			if ($insuranceData && $insuranceData['insurance_id']){
				
				Trip_insurance::find($insuranceData['insurance_id'])->update(array_except($insuranceData, ['insurance_id']));
			}
			DB::commit();
			return redirect()->route('triplist',['user'=>Auth::user()->UserID]);
		} catch (Exception $e) {
			DB::rollBack();
		}
	}
	public function demosticCancel(TripCancelRequest $request,Trip $trip) 
	{
		$user_id=Auth::user()->UserID;
		$trip->status='cancelled';
		$trip->save();
		return redirect('/etravel/'.$user_id.'/triplist?status=cancelled');
	}
	public function nationalCancel(TripCancelRequest $request,Trip $trip)
	{
		$user_id=Auth::user()->UserID;
		$trip->status='cancelled';
		$trip->save();
		return redirect('/etravel/'.$user_id.'/triplist?status=cancelled');
	}
	
}