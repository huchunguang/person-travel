<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;
use App\Trip;
use App\Http\Requests\TripReadRequest;
use App\User;
use App\Country;

class PritingController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * 
	 * @return Response
	 */
	public function index(TripReadRequest $request,Trip $trip)
	{
		if ($trip->isNationalTrip($trip)){
			$pdf_file=url('/trip/printing-national/'.$trip->trip_id);
		}else{
			$pdf_file=url('/trip/printing-domestic/'.$trip->trip_id);
			
		}
		return view('/etravel/printing/index',compact('pdf_file'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * render the pdf of international trip to browser
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showNationalTrip(Request $request,Trip $trip)
	{
		
		$overseas_approver=[];
		$applicantUser = User::where('UserID', $trip->applicant_id)->firstOrFail();
		$userObjMdl = User::where('UserID',$trip->user_id)->firstOrFail();
		if ($trip->overseas_approver){
			$overseas_approver=User::find($trip->overseas_approver);
		}
		$approver = User::find($trip->department_approver);
		$hotelData = $trip->accomodation()->get();
		$estimateExpenses = $trip->estimateExpense()->get();
		$flightData = $trip->flight()->get();
		$insuranceData = $trip->insurance()->first();
		// 		dd($trip->overseasApprover()->first()['FirstName']);
		$destination=Country::whereIn('CountryID',$trip->destination_id)->get();
		$rep_office = User::find($trip->hotel_prefer['rep_office']);
		
		$render_html = view('/etravel/printing/internationalTrip', [
			'userObjMdl' => $userObjMdl,
			'applicantUser'=>$applicantUser,
			'trip' => $trip,
			'approver' => $approver,
			'overseas_approver' => $overseas_approver,
			'hotelData' => $hotelData,
			'estimateExpenses' => $estimateExpenses,
			'flightData' => $flightData,
			'insuranceData' => $insuranceData,
			'destination' => $destination,
			'rep_office' => $rep_office,
			'costCenterCode' => $trip->costcenter()->first()->CostCenterCode,
			'department' => $trip->department()->first()->Department,
			'cc' => $trip->cc
			
		])->render();
		// 		dd($render_html);
		
		return $this->renderPdf($render_html);
	}
	
	/**
	 * render the pdf of domestic trip to browser
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showDomesticTrip(TripReadRequest $request,Trip $trip)
	{
		$applicantUser = User::where('UserID', $trip->applicant_id)->firstOrFail();
		$userObjMdl = User::where('UserID', $trip->user_id)->firstOrFail();
		// 		dd($trip->department_approver);
		$approver = User::find($trip->department_approver);
		$approvedCnt = $trip->demostic()->where(['is_approved'=>1])->count();
		if (empty($approvedCnt)){
			$approvedCnt=$trip->demostic()->count();
		}
		$demosticInfo = $trip->demostic()->get();
		$render_html=view('/etravel/printing/domesticTrip', [
			'userObjMdl'=>$userObjMdl,
			'applicantUser'=>$applicantUser,
			'trip' => $trip,
			'approver'=>$approver,
			'approvedCnt'=>$approvedCnt,
			'demosticInfo' => $demosticInfo,
			'department' => $trip->department()->first()->Department,
			'costCenterCode' => $trip->costcenter()->first()->CostCenterCode,
		]);
		
		return $this->renderPdf($render_html);
	}

	
	public function renderPdf($render_html)
	{
		$pdf = \PDF::loadHTML($render_html);
		return $pdf->stream('Etravel-printing.pdf');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
