<?php
namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Contacts\SystemVariable;
use App\Repositories\TripRepository;
use Carbon\Carbon;
use App\Http\Apis\Classes\EhotelApi;
use App\Overtime;
use App\Repositories\OvertimeRepository;

class DashboardController extends Controller
{
	public function __construct(SystemVariable $system, OvertimeRepository $trip)
	{
		$this->system = $system;
		$this->overtime = $trip;
	}

	/**
	 * @desc show the overtime dashboard related with all info
	 * @param Request $request
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request)
	{
// 		[
// 			'pendingCount'=>$this->overtime->countByStatus('pending'),
// 			'approved'=>$this->overtime->countByStatus('approved'),
// 		]
		return view('/overtime/dashboard/index');
		$approvedRequests = [ ];
		$generalAnnouncement = $this->system->getAnnouncement();
		$approvedRequests = $this->trip->getListByStatus('approved');
		$pendingRequests = $this->trip->getListByStatus('pending');
		$staffTripList = $this->trip->staffTripByStatus()->groupBy('status');
		
		$incomingTrips = $approvedRequests->filter(function ($item) {
			$daterange_from = Carbon::createFromFormat('m/d/Y', $item->daterange_from)->getTimestamp();
			return $daterange_from >= time();
		});
// 		dd($staffTripList->toArray());
		return view('/overtime/dashboard/index', [ 
			'staffTripList'=>$staffTripList,
			'approved_request' => $approvedRequests,
			'pendingRequests'=>$pendingRequests,
			'generalAnnouncement' => $generalAnnouncement,
			'incomingTrips'=>$incomingTrips,
			'staffTripCnt'=>count($this->trip->staffTripByStatus()),
		]);
    }
    public function unknownUser(Request $request) 
    {
        
        return view('/etravel/dashboard/unknownUser')->with('userName',$request->input('userName'));
    }
}