<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model {

	//
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
	];
	 public static $supposeStatus=[
		
		'pending',
		'rejected',
		'approved',
		'cancelled'
	];
	 
	 public function scopeOfStatus($query,$param)
	 {
		if (empty($param)) return $query;
		
		return in_array($param, self::$supposeStatus) ? $query->where('status', $param) : $query;
	}
	public function setStatusAttribute($value)
	{
		
		$this->attributes['status']=isset($value)?$value:'pending';
	}
}
