<?php
namespace App\Http\Controllers\Etravel;

use App\Contacts\SystemVariable;
use App\Http\Controllers\Controller;
use App\Repositories\TripRepository;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Trip_flight;
use Illuminate\Queue\Console\RetryCommand;

class DashboardController extends Controller
{
	public function __construct(SystemVariable $system, TripRepository $trip)
	{
		$this->system = $system;
		$this->trip = $trip;
	}

	/**
	 * @desc show the etravel dashboard related with all trip info
	 * @param Request $request
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request)
	{
		$approvedRequests = array();
		$generalAnnouncement = $this->system->getAnnouncement();
		$approvedRequests = $this->trip->getListByStatus('approved');
		$pendingRequests = $this->trip->getListByStatus('pending');
		$staffTripList = $this->trip->staffTripByStatus()->groupBy('status');
		$incomingTrips = $approvedRequests->toArray();
// 		dd(($staffTripList['pending'][0]->toArray()));
// 		->filter(function ($item) {
// 			$daterange_from = Carbon::createFromFormat('m/d/Y', $item->daterange_from)->getTimestamp();
// 			$daterange_to = Carbon::createFromFormat('m/d/Y', $item->daterange_to)->getTimestamp();
// 			return $daterange_from <= time() && $daterange_to>=time();
// 		})
		$trip_ids=array_pluck($incomingTrips, 'trip_id');
// 		dd($trip_ids);
		$incomingTrips = Trip_flight::whereIn('trip_id',$trip_ids)->orderBy('flight_date','DESC')->limit(10)->get()->filter(function($item){
			$flight_date= Carbon::createFromFormat('m/d/Y', $item->flight_date)->getTimestamp();
			return $flight_date>=time();
		});
		return view('/etravel/dashboard/index', [ 
			
			'staffTripList' => $staffTripList,
			'approved_request' => $approvedRequests,
			'pendingRequests' => $pendingRequests,
			'generalAnnouncement' => $generalAnnouncement,
			'incomingTrips' => $incomingTrips,
			'staffTripCnt' => count($this->trip->staffTripByStatus())
		]);
	}
    public function unknownUser(Request $request) 
    {
		return view('/etravel/dashboard/unknownUser')->with('userName', $request->input('userName'));
	}
    /**
     * @desc  create a travel request be determined by trip type id 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trip(Request $request) 
    {
		if ($request->input('trip') == '2') {
			return redirect()->route('demosticCreate');
		} elseif ($request->input('trip') == '1') {
			return redirect()->route('internationalCreate');
		}
	}
}