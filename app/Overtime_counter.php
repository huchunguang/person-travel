<?php namespace App;

use App\Http\Traits\counterSeries;
use Illuminate\Database\Eloquent\Model;

class Overtime_counter extends Model
{
	use counterSeries;

	protected $fillable = [ 
		
		'company_id',
		'year',
		'total_number'];
	protected static $identityStr='O';
}
