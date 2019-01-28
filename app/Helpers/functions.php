<?php

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

if (!function_exists('GetWindowsUsername')) {
	
	function GetWindowsUsername(){
		if (isset($_SERVER['AUTH_USER'])) {
			$user = $_SERVER['AUTH_USER'];
			$user2 = strstr($user, '\\');
			$user3 = substr($user2, 1, strlen($user2) - 1);
		}else {
			$user3 = '';
		}
		return $user3;
	}
}


if (!function_exists('array_bound_key')) {
	
	function array_bound_key($arr)
	{
		$newArr = [ ];
		foreach ($arr as $key => $item) {
			$i = 0;
			if (!is_array($item))continue;
			foreach ($item as $val) {
// 				if (''==$val) continue 2;
				$newArr[$i][$key] = $val;
				$i ++;
			}
		}
		return $newArr;
	}
}

if (!function_exists('auto_generate_ref')){
	
	function auto_generate_ref($counter,$identityStr='T'){
		if (Auth::check()){
			$user = Auth::user();//compatible with php5.4
			$company_code = $user->company()->first()->CompanyCode;
			$year = Carbon::now()->year;
			$seriesNum=isset($counter)&&!empty($counter)?(int)$counter+1:1;
			$seriesNum = str_pad($seriesNum, 6,'0',STR_PAD_LEFT);
			return $company_code.$year.$seriesNum.$identityStr;
		}
		return false;
	}
}