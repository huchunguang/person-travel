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
		$country_id = empty($country_id) ? $this->system->CountryAssignedID : $country_id;
		$site_id = $request->input('site_id');
		$company_id = $request->input('company_id');
		$trip_type=$request->input('trip_type');
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$siteList = $this->siteListHRSecurity($country_id);
		$companyList = $this->getCompanyListHRSecurity($site_id);
		$departmentList = $this->getDepByCompanySite($site_id, $company_id);
		if ($country_id){
			$searchFilter = $this->prepareSearchFilter($request);
			$country_tmp = $request->input('country_id');
			if(empty($country_tmp)){
				$searchFilter['country_id'] = $this->system->CountryAssignedID;
			}
			if(empty($site_id)){
				$searchFilter['site_id']=$this->system->SiteID;
			}
			if(empty($company_id)){
				$searchFilter['company_id']=$this->system->CompanyID;
			}
// 			dd($searchFilter);
			$baseFilter=array_except($searchFilter, ['daterange_from','daterange_to']);
			$betweenFilter=[$searchFilter['daterange_from'],$searchFilter['daterange_to']];
// 			print_r($baseFilter);
			$tripList = Trip::where($baseFilter)->whereBetween('daterange_from',$betweenFilter)->whereBetween('daterange_to',$betweenFilter)->paginate(PAGE_SIZE);
			$tripList->appends($request->all());
			
		}
		$daterange_from = $searchFilter['daterange_from'];
// 		print_r($searchFilter);
		$daterange_to = $searchFilter['daterange_to'];
		unset($searchFilter);
		return view('/etravel/admin/triplist/index', compact('country_id','site_id','company_id','countryList', 'siteList', 'companyList','departmentList','breadcrumb','tripList','status','trip_type','daterange_from','daterange_to'));
	}
}