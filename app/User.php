<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

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
}
