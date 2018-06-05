<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Static_;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Trip_counter extends Model {

	//
	protected $fillable=['company_id','year','total_number'];
	public static function updateSeries() 
	{
		$company_id = Auth::user()->CompanyID;
		$year = Carbon::now()->year;
		$tripCounter= static::where('company_id',$company_id)->where('year',$year)->first();
		if ($tripCounter){
			$tripCounter->total_number +=1;
			$tripCounter->save();
		}else{
			$tripCounter=new static;
			$tripCounter->company_id = $company_id;
			$tripCounter->year = $year;
			$tripCounter->total_number +=1;
			$tripCounter->save();
		}
		return $tripCounter;
	}
}
