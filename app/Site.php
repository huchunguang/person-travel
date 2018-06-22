<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model {

	//
	protected $table = 'site';
	protected $primaryKey='SiteID';
	public function users()
	{
		return $this->hasMany('App\User','SiteID','SiteID');
	}
}
