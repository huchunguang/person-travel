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
// 		$test=new Carbon();
// 		$test->format('Y-m-d');
		$breadcrumb='Travel Requests';
		$country_id = $request->input('country_id');
		$site_id = $request->input('site_id');
		$company_id = $request->input('company_id');
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$siteList = $this->siteListHRSecurity($country_id);
		$companyList = $this->getCompanyListHRSecurity($site_id);
		$departmentList = $this->getDepByCompanySite($site_id, $company_id);
		$tripList=Trip::paginate(15);
// 		dd($tripList->toArray());
// 		dd($departmentList->toArray());
// 		dd($this->system->CountryAssignedID);
		return view('/etravel/admin/triplist/index', compact('countryList', 'siteList', 'companyList','departmentList','breadcrumb','tripList'));
	}
}