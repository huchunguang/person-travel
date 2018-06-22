<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Delegation extends Model {

	protected $table='delegation';
	protected $primaryKey='DelegationID';

	protected $fillable = [ 
		
		'DelegationID',
		'ManagerID',
		'ManagerDelegationID',
		'DelegationStartDate',
		'DelegationEndDate',
		'EnableDelegation'
	];
	public $timestamps=false;
	public function setDelegationStartDateAttribute($value)
	{
		$this->attributes['DelegationStartDate'] = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$1-$2', $value);
	}
	public function setDelegationEndDateAttribute($value)
	{
		$this->attributes['DelegationEndDate'] = preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$1-$2', $value);
	}
}
