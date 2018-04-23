<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) 
    {
        return view('/etravel/dashboard/index');
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