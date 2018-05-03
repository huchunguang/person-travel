<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip_announcement extends Model {

	//
	protected $guarded= [''];
	public function announceType() 
	{
		return $this->hasOne('App\Trip_announcetype','id','type_id');
	}
}
