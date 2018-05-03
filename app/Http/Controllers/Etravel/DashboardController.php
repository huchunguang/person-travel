<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Contacts\SystemVariable;

class DashboardController extends Controller
{
	public function __construct(SystemVariable $system)
	{
		$this->system = $system;	
	}
	
    public function index(Request $request) 
    {
    		$generalAnnouncement = $this->system->getAnnouncement();
    		$approvedRequest= Trip::where(['user_id'=>Auth::user()->UserID,'status'=>'approved'])->orderBy('updated_at','DESC')->limit(5)->get();
			// dd($approved_request);
			
		return view('/etravel/dashboard/index', [ 
			
			'approved_request' => $approvedRequest,
			'generalAnnouncement' => $generalAnnouncement
		]);
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