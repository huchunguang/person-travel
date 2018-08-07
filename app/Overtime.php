<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\readRequestCreator;

class Overtime extends Model
{
	
	use readRequestCreator;

	protected $fillable = [ 
		
		'igg',
		'head_count',
		'shift',
		'hours',
		'rate',
		'reason',
		'start_date',
		'end_date',
		'hr_approver',
		'remark',
		'user_id',
		'status',
		'reference_id',
		'department_id',
		'country_id',
		'site_id',
		'company_id'
	];

	public static $supposeStatus = [ 
		
		'pending',
		'rejected',
		'approved',
		'cancelled'
	];

	public function scopeOfStatus($query, $param)
	{
		if (empty($param)) return $query;
		
		return in_array($param, self::$supposeStatus) ? $query->where('status', $param) : $query;
	}

	public function setStatusAttribute($value)
	{
		$this->attributes['status'] = isset($value) ? $value : 'pending';
	}

	public function shift()
	{
		return $this->hasOne('App\Overtime_shift', 'id', 'shift');
	}

	public function rate()
	{
		return $this->hasOne('App\Overtime_rate', 'id', 'rate');
	}

	public function reason()
	{
		return $this->hasOne('App\Overtime_reason', 'id', 'reason');
	}

	public function igg()
	{
		return $this->hasOne('App\Overtime_igg', 'id', 'igg');
	}

	public function getPositionAttribute($value = null)
	{
		return $this->user()->first()->WorkPosition;
	}
	
}
