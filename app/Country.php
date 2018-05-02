<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

	//
	protected $table='country';
	protected $primaryKey='CountryID';
	public function sites() 
	{
		return $this->hasMany('App\Site','CountryID','CountryID');
	}
}
