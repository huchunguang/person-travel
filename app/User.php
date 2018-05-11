<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;

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
		$user_id=Auth::user()->UserID;
		$userProfile = User::with('costcenter', 'department', 'site')->where('UserName', Auth::user()->UserName)->first();
		$departmentFilter['SiteID'] = $userProfile['SiteID'];
		$departmentFilter['DepartmentID'] = $userProfile['DepartmentID'];
		$departmentFilter['CompanyID'] = $userProfile['CompanyID'];
		$approvers = Department_approver::where($departmentFilter)->first([
			'Approver1'
		])->toArray();
		
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
		$approvers = User::whereIn('UserID', $userIds)->get()->toArray();
		return [
			'userProfile'=>$userProfile,
			'approvers'=>$approvers
		];
	}
}

