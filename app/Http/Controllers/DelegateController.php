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
		$breadcrumb='delegation';
		$countryId = $request->input('country_id',old('country_id')?old('country_id'):$this->system->countryId);
		$siteId = $request->input('site_id',old('site_id')?old('site_id'):$this->system->siteId);
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$siteList =  Site::where(['CountryID'=>$countryId])->get();
		$userListBySite = User::where('SiteID',$siteId)->get(['FirstName','LastName','UserID']);
		$delegateUser = User::find(old('ManagerDelegationID'));
		return view('/etravel/delegate/index',compact('breadcrumb','countryList','siteList','userListBySite','delegateUser'));
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
	 * Store and Update a delegation entity
	 * @param $request Request
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$delegationId=$request->input('delegationId');
		if (!$delegationId){
			if (Delegation::where(['ManagerID'=>Auth::user()->UserID])->exists()){
				$delegationId = Delegation::where(['ManagerID'=>Auth::user()->UserID])->first()->DelegationID;
				goto update;
			}
			$res = Delegation::create($request->all());
			return redirect('delegate/index')->withInput()->with('delegationId',$res->DelegationID);
		}else{
// 			dd($request->all());
			update:
			$updata = $request->only(['ManagerID','ManagerDelegationID','DelegationStartDate','DelegationEndDate','EnableDelegation']);
			Delegation::find($delegationId)->update($updata);
			return redirect('delegate/index')->withInput()->with('delegationId',$delegationId);
		}
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
