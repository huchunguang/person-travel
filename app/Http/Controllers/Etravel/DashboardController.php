<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request) 
    {
    		$approved_request= Trip::where(['user_id'=>Auth::user()->UserID,'status'=>'approved'])->orderBy('updated_at','DESC')->limit(5)->get();
//     		dd($approved_request);
        return view('/etravel/dashboard/index',['approved_request'=>$approved_request]);
    }
    public function unknownUser(Request $request) 
    {
        
        return view('/etravel/dashboard/unknownUser')->with('userName',$request->input('userName'));
    }
    /**
     * @desc determine that would like to create trip type 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trip(Request $request) 
    {
		if ($request->input('trip') == 'demostic') {
			return redirect()->route('demosticCreate');
		} elseif ($request->input('trip') == 'international') {
			return redirect()->route('internationalCreate');
		}
	}
}