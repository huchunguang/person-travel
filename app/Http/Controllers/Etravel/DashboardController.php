<?php
namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip;
use Illuminate\Support\Facades\Auth;
use App\Contacts\SystemVariable;
use App\Repositories\TripRepository;

class DashboardController extends Controller
{
	public function __construct(SystemVariable $system,TripRepository $trip)
	{
		$this->system = $system;	
		$this->trip=$trip;
	}
	
    public function index(Request $request) 
    {
    		$generalAnnouncement = $this->system->getAnnouncement();
    		$approved_request=[];
    		$approved_request = $this->trip->getListByStatus('approved');
    		$pendingRequests=$this->trip->getListByStatus('pending');
    		$staffTripList=$this->trip->staffTripByStatus()->groupBy('status');
//     		dd($staffTripList);
//     		dd($staffTripList['pending'][0]->user()->first()['FirstName']);
    		foreach ($pendingRequests as $item)
    		{
    			$item->destination_name=$this->trip->getTripDst($item);
    		}
//     		dd($pendingRequests->toArray());
		return view('/etravel/dashboard/index', [ 
			'staffTripList'=>$staffTripList,
			'approved_request' => $approved_request,
			'pendingRequests'=>$pendingRequests,
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