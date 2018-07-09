<?php
namespace App\Http\Controllers\Etravel\Admin;

use Illuminate\Http\Request;
use App\Country;
use App\Trip;
use Carbon\Carbon;
use App\Http\Traits\parseSearchFilter;
class TriplistController extends AdminController
{
	use parseSearchFilter;
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
}