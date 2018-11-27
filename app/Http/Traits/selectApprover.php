<?php namespace App\Http\Traits;



use App\Department_approver;
use Illuminate\Support\Facades\Auth;
use App\User;

trait selectApprover
{
	public static $userId;
	public static $approverAssocOrigin=array();
	public static function getDepApprover($departmentFilter,$user=null)
	{
		$user=$user?$user:Auth::user();
		self::$userId= $user->UserID;
		$approvers=[];
// 		dd($departmentFilter);
		if (Department_approver::where($departmentFilter)->exists()) {
			$originalUserIds=$delegatedUserIds=self::checkOriginalApprover($departmentFilter);
						
			if (method_exists(get_called_class(), 'checkIsDelegate')){
				array_walk($delegatedUserIds, [
					
					'self',
					'checkIsDelegate'
				]);
			}
// 			dd(array_diff_assoc($delegatedUserIds, $originalUserIds));
			self::$approverAssocOrigin=array_combine(array_diff_assoc($delegatedUserIds, $originalUserIds), array_diff_assoc($originalUserIds,$delegatedUserIds));
// 			dd(self::$approverAssocOrigin);
// 			dd($userIds);
			$approvers = User::whereIn('UserID', $delegatedUserIds)->get()->toArray();
		}
		
		return $approvers;
		
	}
	
	public static function checkOriginalApprover($departmentFilter)
	{
		$user_id=self::$userId;
		$approvers = Department_approver::where($departmentFilter)->first([
			
			'Approver1'
		])->toArray();
		// 			dd($approvers);
		$userIds = explode(',', $approvers['Approver1']);
		// 			dd($user_id);
// 					dd($userIds);
		if (in_array($user_id, $userIds) || empty($userIds)) {
			$approvers = Department_approver::where($departmentFilter)->first([
				
				'Approver2'
			])->toArray();
			
			$userIds = explode(',', $approvers['Approver2']);
			if (in_array($user_id, $userIds) || empty($userIds)) {
				$approvers = Department_approver::where($departmentFilter)->first([
					
					'Approver3'
				])->toArray();
				
				$userIds = explode(',', $approvers['Approver3']);
			}
		}
		return $userIds;
		
	}
	
	
}
