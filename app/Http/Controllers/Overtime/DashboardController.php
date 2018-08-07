<?php
namespace App\Http\Controllers\Overtime;

use App\Contacts\SystemVariable;
use App\Http\Controllers\Controller;
use App\Overtime;
use App\Repositories\OvertimeRepository;
use App\Trip;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

	public function __construct(SystemVariable $system, OvertimeRepository $trip)
	{
		$this->system = $system;
		$this->overtime = $trip;
	}

	/**
	 * show the overtime dashboard related with all info
	 * 
	 * @param Request $request        	
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request)
	{
		return view('/overtime/dashboard/index');
    }
    
    public function unknownUser(Request $request) 
    {
        
        return view('/etravel/dashboard/unknownUser')->with('userName',$request->input('userName'));
    }
}