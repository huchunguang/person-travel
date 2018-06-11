<?php
namespace App\Http\Controllers\Etravel\Admin;

use Illuminate\Http\Request;
use App\Country;
use App\Trip;
use Carbon\Carbon;
class TriplistController extends AdminController
{
	
	public function index(Request $request)
	{
		$breadcrumb='Travel Requests';
		$status = $request->input('status');
		$country_id = $request->input('country_id');
		$site_id = $request->input('site_id');
		$company_id = $request->input('company_id');
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$siteList = $this->siteListHRSecurity($country_id);
		$companyList = $this->getCompanyListHRSecurity($site_id);
		$departmentList = $this->getDepByCompanySite($site_id, $company_id);
		if ($country_id){
			$searchFilter = $this->prepareSearchFilter($request);
// 			dd($searchFilter);
			$baseFilter=array_except($searchFilter, ['daterange_from','daterange_to']);
			$betweenFilter=[$searchFilter['daterange_from'],$searchFilter['daterange_to']];
			$tripList = Trip::where($baseFilter)->whereBetween('daterange_from',$betweenFilter)->whereBetween('daterange_to',$betweenFilter)->paginate(PAGE_SIZE);
			$tripList->appends($request->all());
			unset($searchFilter);
		}else{
			$tripList=Trip::whereBetween('daterange_from',[Carbon::now()->subDays(30)->format('m/d/Y'),Carbon::today()->format('m/d/Y')])->paginate(PAGE_SIZE);
		}
// 		dd($tripList->toArray());
		return view('/etravel/admin/triplist/index', compact('countryList', 'siteList', 'companyList','departmentList','breadcrumb','tripList','status'));
	}
	protected function prepareSearchFilter(Request $request)
	{
		$searchFilter=[];
		if($request->has('country_id')){
			$searchFilter['country_id'] = $request->input('country_id');
		}
		if($request->has('site_id')){
			$searchFilter['site_id'] = $request->input('site_id');
		}
		if($request->has('company_id')){
			$searchFilter['company_id'] = $request->input('company_id');
		}
		if($request->has('department_id')){
			$searchFilter['department_id'] = $request->input('department_id');
		}
		if($request->has('trip_type')){
			$searchFilter['trip_type'] = $request->input('trip_type');
		}
		if($request->has('status')){
			$searchFilter['status'] = $request->input('status');
		}
		if($request->has('daterange_from')){
			$searchFilter['daterange_from'] = $request->input('daterange_from');
		}else{
			$searchFilter['daterange_from'] = Carbon::now()->firstOfMonth()->format('m/d/Y');
		}
		if($request->has('daterange_to')){
			$searchFilter['daterange_to'] = $request->input('daterange_to');
		}else{
			$searchFilter['daterange_to'] = Carbon::now()->format('m/d/Y');
		}
		return $searchFilter;
	}
}