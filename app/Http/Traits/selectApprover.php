<?php namespace App\Http\Traits;



use App\Department_approver;
use Illuminate\Support\Facades\Auth;
use App\User;

trait selectApprover
{
	public static function getDepApprover($departmentFilter)
	{
		$user_id = Auth::user()->UserID;
		$approvers=[];
		if (Department_approver::where($departmentFilter)->exists()) {
			$approvers = Department_approver::where($departmentFilter)->first([
				
				'Approver1'
			])->toArray();
			
			$userIds = explode(',', $approvers['Approver1']);
			if (in_array($user_id, $userIds)) {
				$approvers = Department_approver::where($departmentFilter)->first([
					
					'Approver2'
				])->toArray();
				
				$userIds = explode(',', $approvers['Approver2']);
				if (in_array($user_id, $userIds)) {
					$approvers = Department_approver::where($departmentFilter)->first([
						
						'Approver3'
					])->toArray();
					
					$userIds = explode(',', $approvers['Approver3']);
				}
			}
			if (method_exists('self', 'checkIsDelegate')){
				array_walk($userIds, [
					
					'self',
					'checkIsDelegate'
				]);
			}
			
			$approvers = User::whereIn('UserID', $userIds)->get()->toArray();
		}
		
		return $approvers;
		
	}
	
	
}
