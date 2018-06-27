<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Static_;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    
    use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'UserID';
	protected $hidden=array(
		'Pwd','remember_token'
	);
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function costcenter()
	{
	   return $this->belongsTo('App\Costcenter','DefaultCostCenterID','CostCenterID');    
	}
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function department() 
	{
	    return $this->belongsTo('App\Department','DepartmentID','DepartmentID');
	}
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function site() 
	{
	    return $this->belongsTo('App\Site','SiteID','SiteID');
	}
	public function manager(){
		return $this->hasOne('App\User','UserID','ManagerID');
	}
	public function tripList()
	{	
		return $this->hasMany('App\Trip','user_id','UserID');
	}
	public function company()
	{
		return $this->hasOne('App\Company','CompanyID','CompanyID');
	}
	public static function getUserProfile()
	{
		$approvers = $departmentFilter = [ ];
		$user_id=Auth::user()->UserID;
		$userProfile = User::with('costcenter', 'department', 'site')->where('UserName', Auth::user()->UserName)->first();
		$departmentFilter['SiteID'] = $userProfile['SiteID'];
		$departmentFilter['DepartmentID'] = $userProfile['DepartmentID'];
		$departmentFilter['CompanyID'] = $userProfile['CompanyID'];
		if (Department_approver::where($departmentFilter)->exists()){
			$approvers=Department_approver::where($departmentFilter)->first(['Approver1'])->toArray();
			$userIds = explode(',', $approvers['Approver1']);
			if(in_array($user_id, $userIds))
			{
				$approvers = Department_approver::where($departmentFilter)->first([
					'Approver2'
				])->toArray();
				
				$userIds = explode(',', $approvers['Approver2']);
				if(in_array($user_id, $userIds))
				{
					$approvers = Department_approver::where($departmentFilter)->first([
						'Approver3'
					])->toArray();
					
					$userIds = explode(',', $approvers['Approver3']);
					
				}
				
			}
			array_walk($userIds, ['self','checkIsDelegate']);
			$approvers = User::whereIn('UserID', $userIds)->get()->toArray();
		}
		
		return [
			'userProfile'=>$userProfile,
			'approvers'=>$approvers
		];
	}
	/**
	 * @brief replace approvers with delegate user 
	 * @param unknown $value
	 * @param unknown $key
	 */
	public static function checkIsDelegate(&$value,$key)
	{
		if(Delegation::where(['ManagerID'=>$value,'EnableDelegation'=>1])->exists()){
			$delegation = Delegation::where(['ManagerID'=>$value])->first();
			$currentDate = Carbon::now();
			if($currentDate->lte(Carbon::parse($delegation->DelegationEndDate)) && $currentDate->gte(Carbon::parse($delegation->DelegationStartDate))){
				$value = $delegation->ManagerDelegationID;
			}
			
		}else{
			//to do something what you need 
		}
	}
}

