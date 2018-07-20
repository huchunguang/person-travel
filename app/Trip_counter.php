<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Static_;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Traits\counterSeries;

class Trip_counter extends Model {
	use counterSeries;
	protected $fillable=['company_id','year','total_number'];
	protected static $identityStr='T';
}
