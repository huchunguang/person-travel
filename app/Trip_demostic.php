<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip_demostic extends Model {
	
	protected $guarded= [''];
	public function visitPurpose()
	{
		return $this->hasOne('App\Trip_purpose','purpose_id','purpose_id');
	}
}
