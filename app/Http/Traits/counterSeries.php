<?php namespace App\Http\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait counterSeries
{
	public static function updateSeries()
	{
		$company_id = Auth::user()->CompanyID;
		$year = Carbon::now()->year;
		$tripCounter = static::where('company_id', $company_id)->where('year', $year)->first();
		if ($tripCounter) {
			$tripCounter->total_number += 1;
			$tripCounter->save();
		} else {
			$tripCounter = new static();
			$tripCounter->company_id = $company_id;
			$tripCounter->year = $year;
			$tripCounter->total_number += 1;
			$tripCounter->save();
		}
		return $tripCounter;
	}

	public static function generateRefId()
	{
		$tripCounter = static::where('year', Carbon::now()->year)->where('company_id', Auth::user()->CompanyID)->first();
		$counterNum = $tripCounter ? $tripCounter->total_number : 0;
		return auto_generate_ref($counterNum,static::$identityStr);
	}
}
