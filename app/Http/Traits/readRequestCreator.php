<?php namespace App\Http\Traits;



trait readRequestCreator
{
	public function getUserName()
	{
		$user = $this->user()->first();
		return $user->LastName.' '.$user->FirstName;
	}
	
	public function user()
	{
		return $this->belongsTo('App\User','user_id','UserID');
	}
	public function hr_approver()
	{
		return $this->hasOne('App\User','UserID','hr_approver');
	}
	public function getHrApproverName()
	{
		$hr = $this->hr_approver()->first();
		return $hr->LastName.' '.$hr->FirstName;
	}
}
