<?php namespace App\Http\Controllers\Etravel;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip_purpose;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Etravel\Admin\AdminController;
use App\Country;

class PurposeController extends AdminController {

	/**
	 * Display a listing of the demostic visit purpose.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		
		$purposeList = $countryList = $siteList = $companyList = array();
		$country = $request->input('country');
		if ($country && !in_array($country, $this->system->accessCountryIds)) return back();
		$siteId = $request->input('site_id');
		$companyId = $request->input('company_id');
		if ($siteId || $country || $companyId){
			$tripAnnouncement=Trip_purpose::where('disabled','0');
			$country?$tripAnnouncement->where('country',$country):'';
			$siteId?$tripAnnouncement->where('site_id',$siteId):'';
			$companyId?$tripAnnouncement->where('company_id',$companyId):'';
			$purposeList =$tripAnnouncement->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		}else{
			$purposeList = Trip_purpose::where('disabled','0')->whereIn('company_id',$this->system->accessCompanyIds)->whereIn('site_id',$this->system->accessSiteIds)->orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		}
		if ($country){
			$siteList = $this->siteListHRSecurity($country);
		}
		
		if ($siteId){
			$companyList = array_pluck($this->getCompanyListHRSecurity($siteId)->toArray(),'company');
		}
		// 		dd($announcementList->toArray());
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		return view('/etravel/purpose/index', [
			
			'breadcrumb' => 'Announcements',
			'purposeList' => $purposeList,
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
		return view('/etravel/purpose/create',['countryList'=>$countryList]);
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules=[
			'purpose_catgory'=>'required|unique:trip_purposes|max:255',
			'purpose_desc'=>'required|max:255',
			'country'=>'required|integer',
			'site_id'=>'required|integer',
			'company_id'=>'required|integer',
		];
		$this->validate($request, $rules);
// 		dd($request->all());
		$purpose = new Trip_purpose();
		$purpose->country = $request->input('country');
		$purpose->site_id= $request->input('site_id');
		$purpose->company_id= $request->input('company_id');
		$purpose->purpose_catgory=$request->input('purpose_catgory');
		$purpose->purpose_desc=$request->input('purpose_desc');
		if ($purpose->save()) {
			return redirect('etravel/purpose');
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Trip_purpose $purpose)
	{
		echo view('/etravel/purpose/show',['purpose'=>$purpose]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Trip_purpose $purpose)
	{
		$countryList = array();
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$siteList=$this->siteListHRSecurity($purpose['country']);
		$companyList=array_pluck($this->getCompanyListHRSecurity($purpose['site_id'])->toArray(), 'company');
		return view('etravel/purpose/edit', [
			
			'purpose' => $purpose,
			'countryList' => $countryList,
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
	public function update(Request $request,Trip_purpose $purpose)
	{
		$rules=[
			'purpose_catgory'=>'required|unique:trip_purposes|max:255',
			'purpose_desc'=>'required',
		];
		$this->validate($request, $rules);
		$purpose->purpose_catgory=$request->input('purpose_catgory');
		$purpose->purpose_desc=$request->input('purpose_desc');
		$purpose->save();
		echo view('/etravel/purpose/show',['purpose'=>$purpose]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Trip_purpose $purpose)
	{
		if ($purpose->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
	}

}
