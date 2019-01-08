<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegation extends Model {

	protected $table='delegation';
	protected $primaryKey='DelegationID';
	protected $fillable = [ 
		'country_id',
		'DelegationID',
		'ManagerID',
		'ManagerDelegationID',
		'DelegationStartDate',
		'DelegationEndDate',
		'EnableDelegation',
		
	];
	public $timestamps=false;
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function manager()
	{
		return $this->belongsTo('App\User','ManagerID','UserID');
	}
	
	public function delegatedCountry()
	{
		return $this->belongsTo('App\Country','country_id','CountryID');
	}
	
	public function delegatedApprover()
	{
		return $this->belongsTo('App\User','ManagerDelegationID','UserID');	
	}
	
	public function setDelegationStartDateAttribute($value)
	{
		$this->attributes['DelegationStartDate'] = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$1-$2', $value);
	}
	
	public function setDelegationEndDateAttribute($value)
	{
		$this->attributes['DelegationEndDate'] = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$1-$2', $value);
	}
	
	public function getEnableDelegationAttribute($value)
	{
		if ($value==1){
			return $this->attributes['EnableDelegation']='enable';
		}else{
			return $this->attributes['EnableDelegation']='disabled';
		}
	}
}
