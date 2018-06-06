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

class AnnouncementController extends Controller
{
	public function __construct(SystemVariable $system) 
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
		$announcementList = $countryList = $siteList = array();
		$country=$request->input('country');
		if ($site_id=$request->input('site_id')){
// 			dd(123);
			$announcementList = Trip_announcement::where('disabled','0')->where('site_id',$site_id)->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		}else{
			$announcementList = Trip_announcement::where('disabled','0')->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		}
		if ($country){
			$countryMdl = Country::find($country);
			$siteList = $countryMdl->sites()->get();
		}
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		return view('/etravel/announcement/index', [ 
			
			'breadcrumb' => 'Announcements',
			'announcementList' => $announcementList,
			'countryList'=>$countryList,
			'siteList'=>$siteList,
			'site_id'=>$site_id,
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
		$countryList = Country::whereIn('CountryID',$this->system->accessCountryIds)->orderBy('Country')->select(['CountryID','Country'])->get();
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
		$country=Country::find($announce['country']);
		$siteList=$country->sites()->get();
		$typeList = Trip_announcetype::all();
		return view('etravel/announcement/edit', [ 
			
			'announce' => $announce,
			'countryList' => $countryList,
			'typeList' => $typeList,
			'siteList' => $siteList
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
