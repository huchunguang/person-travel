<?php namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;
use App\Http\Controllers\SiteController;
use App\Trip_announcetype;
use App\Trip_announcement;
use App\Site;
use App\Contacts\SystemVariable;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Etravel\Admin\AdminController;

class AnnouncementController extends AdminController
{

	/**
	 * Display a listing of the resource.
	 * 
	 * @return Response
	 */
	public function index(Request $request)
	{
		$announcementList = $countryList = $siteList = $companyList = array();
		$country = $request->input('country');
		if ($country && !in_array($country, $this->system->accessCountryIds)) return back();
		$siteId = $request->input('site_id');
		$companyId = $request->input('company_id');
		if ($siteId || $country || $companyId){
			$tripAnnouncement=Trip_announcement::where('disabled','0');
			$country?$tripAnnouncement->where('country',$country):'';
			$siteId?$tripAnnouncement->where('site_id',$siteId):'';
			$companyId?$tripAnnouncement->where('company_id',$companyId):'';
			$announcementList =$tripAnnouncement->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		}else{
			$announcementList = Trip_announcement::where('disabled','0')->whereIn('company_id',$this->system->accessCompanyIds)->whereIn('site_id',$this->system->accessSiteIds)->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		}
		if ($country){
			$siteList = $this->siteListHRSecurity($country);
		}
		
		if ($siteId){
			$companyList = array_pluck($this->getCompanyListHRSecurity($siteId)->toArray(),'company');
		}
// 		dd($announcementList->toArray());
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		return view('/etravel/announcement/index', [ 
			
			'breadcrumb' => 'Announcements',
			'announcementList' => $announcementList,
			'countryList'=>$countryList,
			'siteList'=>$siteList,
			'companyList'=>$companyList,
			'company_id'=>$companyId,
			'site_id'=>$siteId,
			'country'=>$country,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$countryList = array();
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$typeList = Trip_announcetype::all();
		return view('/etravel/announcement/create',['countryList'=>$countryList,'typeList'=>$typeList]);
	}

	/**
	 * Store a newly created announcement into database storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules=array(
			'site_id'=>'required|integer',
			'type_id'=>'required|integer',
			'company_id'=>'required|integer',
// 			'description'=>'required|max:255',
			'date_effectivity'=>'required',
			'date_expired'=>'required',
			'announcement'=>'required'
		);
		$this->validate($request, $rules);
		try {
			Trip_announcement::create($request->except(['_token']));
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
			
		} catch (Exception $e) {
			return response()->json(['res_info'=>['code'=>'100001','msg'=>$e->getMessage()]]);
			
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
	public function edit(Trip_announcement $announce)
	{
		$countryList = array();
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$siteList=$this->siteListHRSecurity($announce['country']);
// 		dd($announce['company_id']);
		$companyList=array_pluck($this->getCompanyListHRSecurity($announce['site_id'])->toArray(), 'company');
		$typeList = Trip_announcetype::all();
		return view('etravel/announcement/edit', [ 
			
			'announce' => $announce,
			'countryList' => $countryList,
			'typeList' => $typeList,
			'siteList' => $siteList,
			'companyList'=>$companyList,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,Trip_announcement $announcement)
	{
		$rules=array(
			'site_id'=>'required|integer',
			'type_id'=>'required|integer',
// 			'description'=>'required|max:255',
			'date_effectivity'=>'required',
			'date_expired'=>'required',
			'announcement'=>'required'
		);
		$this->validate($request, $rules);
		try {
			$announcement->site_id=$request->input('site_id');
			$announcement->type_id=$request->input('type_id');
// 			$announcement->description=$request->input('description');
			$announcement->date_effectivity=$request->input('date_effectivity');
			$announcement->date_expired=$request->input('date_expired');
			$announcement->announcement=$request->input('announcement');
			$announcement->save();
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
			
		} catch (Exception $e) {
			return response()->json(['res_info'=>['code'=>'100001','msg'=>$e->getMessage()]]);
			
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Trip_announcement $announce)
	{
		if ($announce->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}else{
			return response()->json(['res_info'=>['code'=>'100001','msg'=>$e->getMessage()]]);
		}
		
	}

}
