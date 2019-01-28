<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Static_;
use App\Http\Traits\selectApprover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	
	use Authenticatable, CanResetPassword,selectApprover;

	/**
	 * The database table used by the model.
	 * 
	 * @var string
	 */
	protected $table = 'users';

	protected $primaryKey = 'UserID';

	protected $hidden = array ( 
		
		'Pwd',
		'remember_token',
	    'Signature',
	);
	protected $guarded = [
		
		''
	];

	/**
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function costcenter()
	{
		return $this->belongsTo('App\Costcenter', 'DefaultCostCenterID', 'CostCenterID');
	}
	
	public function employmentstatus(){
	    return $this->belongsTo('App\Employmentstatus', 'EmploymentStatusID', 'EmploymentStatusID');
	    
	}
	
	public function employmentcategory(){
	    return $this->belongsTo('App\Employmentcategory', 'EmploymentCategoryID', 'EmploymentCategoryID');
	    
	}

	/**
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function department()
	{
		return $this->belongsTo('App\Department', 'DepartmentID', 'DepartmentID');
	}

	/**
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function site()
	{
		return $this->hasOne('App\Site', 'SiteID', 'SiteID');
	}

	public function manager()
	{
		return $this->hasOne('App\User', 'UserID', 'ManagerID');
	}

	public function tripList()
	{
		return $this->hasMany('App\Trip', 'user_id', 'UserID');
	}
	public function company()
	{
		return $this->hasOne('App\Company', 'CompanyID', 'CompanyID');
	}

	public static function getUserProfile($request=null,$user=null)
	{
		$approvers = $departmentFilter = [ ];
		$user=$user?$user:Auth::user();
// 		dd($user->toArray());
		$userProfile = User::with('costcenter', 'department', 'site')->where('UserName', $user->UserName)->first();
		$departmentFilter['SiteID'] = $userProfile['SiteID'];
		if ($request instanceof Request){
			$departmentFilter['DepartmentID'] = $request->input('department_id',$userProfile['DepartmentID']);
		}elseif(is_integer($request)){
			$departmentFilter['DepartmentID']= $request;
		}else{
			$departmentFilter['DepartmentID'] = $userProfile['DepartmentID'];
		}
		
		$departmentFilter['CompanyID'] = $userProfile['CompanyID'];
// 		dd($departmentFilter);
		$approvers = self::getDepApprover($departmentFilter,$user);
// 		$originalApprovers=self::check
		return [ 
			
			'userProfile' => $userProfile,
			'approvers' => $approvers
		];
	}

	/**
	 * @brief replace approvers to the delegate user
	 * 
	 * @param unknown $value        	
	 * @param unknown $key        	
	 */
	public static function checkIsDelegate(&$value, $key)
	{
	    $whereFilter=[
	        
	        'ManagerID' => $value,
	        'country_id'=>Auth::user()->CountryAssignedID,
	        'EnableDelegation' => 1,
	    ];
	    
	    
	    if (Delegation::where($whereFilter)->exists()) {
	        
	        $currentDate = Carbon::now()->format('Y-m-d');
	        $delegation = Delegation::where($whereFilter)
	        ->where('DelegationStartDate','<=',$currentDate)
	        ->where('DelegationEndDate','>=',$currentDate)
	        ->orderBy('DelegationID','DESC')->first();
	        
	        // 			dd($delegation->DelegationStartDate);
	        $value = $delegation->ManagerDelegationID;
	        
	    }else{
	        //to do something what you need
	    }
	    
	    
	    // 		if ($value==5469){
	    // 		print_r($whereFilter);die;
	    // 		}
	}
	
	public function getSignatureAttribute($value, $mime_type='image/jpeg')
	{
	    
	    $result = '';
	    if (!empty($mime_type) && !empty($value)){
	        $result = 'data:'.$mime_type.';base64,'.base64_encode($value);
	    }
	    return $result;
	    
	}
	
	public function getHrList($columns=['*'])
	{
		$hrUserList = array();
		// 		dd(Auth::user()->SiteID);
		$res = DB::select('SELECT * FROM tbl_hr_access  where find_in_set(:site_id,`SiteIDs`) and `HRRoleID`=1;',$filter=[
			'site_id'=>$this->SiteID,
		]);
		// 		dd($res);
		$hrIds = array_pluck($res, 'HRID');
// 		dd($hrIds);
		$hrUserList = User::whereIn('UserID',$hrIds)->get($columns);
		// 		dd($hrUserList->toArray());
		return $hrUserList;
	}
	
}

