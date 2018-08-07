<?php namespace App\Http\Controllers\Overtime\Hr;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Overtime;
use App\Country;
use App\Http\Traits\parseSearchFilter;
use App\Http\Controllers\Etravel\Admin\AdminController;
use Carbon\Carbon;

class ReportController extends AdminController {
  	use parseSearchFilter;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
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
			$baseFilter=array_except($searchFilter, ['start_date','end_date']);
			$betweenFilter=[$searchFilter['start_date'],$searchFilter['end_date']];
// 			var_dump($baseFilter,$betweenFilter);
			$overtimeList = Overtime::where($baseFilter)->whereBetween('start_date',$betweenFilter)->whereBetween('end_date',$betweenFilter)->paginate(PAGE_SIZE);
// 			dd($overtimeList);
			$overtimeList->appends($request->all());
			unset($searchFilter);
		}else{
			$overtimeList=Overtime::whereBetween('start_date',[Carbon::now()->subDays(30)->format('Y-m-d'),Carbon::today()->format('Y-m-d')])->paginate(PAGE_SIZE);
		}
// 		dd($overtimeList->toArray());
		return view('/overtime/hr/report/index', compact('countryList', 'siteList', 'companyList','departmentList','overtimeList','status'));
		
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
