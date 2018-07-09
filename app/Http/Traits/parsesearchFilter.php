<?php namespace App\Http\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;

trait parseSearchFilter
{
	public function prepareSearchFilter(Request $request) 
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
