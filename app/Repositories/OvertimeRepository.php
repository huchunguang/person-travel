<?php
namespace App\Repositories;

use App\Overtime;
use App\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OvertimeRepository extends Repository
{
	public function model()
	{
		return 'App\Overtime';
	}
	
	public function countByStatus($status='')
	{
		$count=0;
		if ($status){
			$count=Overtime::ofStatus($status)->where('user_id',Auth::user()->UserID)->count();
		}else{
			$count=Overtime::where('user_id',Auth::user()->UserID)->count();
		}
		return $count; 
	}
	
	public function approvalCountByStatus($status='')
	{
		$count=0;
		if ($status){
			$count=Overtime::ofStatus($status)->where('hr_approver',Auth::user()->UserID)->count();
		}else{
			$count=Overtime::where('user_id',Auth::user()->UserID)->count();
		}
		return $count;
	}
}