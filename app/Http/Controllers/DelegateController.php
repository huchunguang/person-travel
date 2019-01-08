<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Country;
use App\Site;
use App\Services\SystemInfo;
use App\User;
use App\Delegation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Events\DelegationNotify;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Cookie;

class DelegateController extends Controller {

	public function __construct(SystemInfo $system)
	{
		$this->system=$system;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$delegateList=Delegation::where(['ManagerID'=>Auth::user()->UserID])->paginate(PAGE_SIZE);
// 		dd($delegateList->toArray());
		return view('/etravel/delegate/index',compact('delegateList'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$breadcrumb='delegation';
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$userListBySite = User::get(['FirstName','LastName','UserID']);
		$delegateUser = User::find(old('ManagerDelegationID'));
		return view('/etravel/delegate/create',compact('breadcrumb','countryList','userListBySite','delegateUser'));
		
	}

	/**
	 * Store and Update a delegation entity
	 * @param $request Request
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$delegationId=$request->input('delegationId');
// 		dd($request->all());
		if (!$delegationId){
			if (Delegation::where(['ManagerID'=>Auth::user()->UserID,'country_id'=>$request->input('country_id')])->exists()){
				$delegationId = Delegation::where(['ManagerID'=>Auth::user()->UserID])->first()->DelegationID;
// 				dd($delegationId);
				goto update;
			}
			$delegation = Delegation::create($request->all());
		}else{
// 			dd($request->all());
			update:
			$updata = $request->only(['country_id','ManagerID','ManagerDelegationID','DelegationStartDate','DelegationEndDate','EnableDelegation']);
			$delegation = Delegation::find($delegationId);
// 			dd($updata);
			$delegation->update($updata);
		}
// 		dd($delegation->DelegationEndDate);
		Event::fire(new DelegationNotify($delegation, $request));
		return redirect('delegate/index')->withInput()->with('delegationId',$delegationId?$delegationId:$delegation->DelegationID);
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

}
