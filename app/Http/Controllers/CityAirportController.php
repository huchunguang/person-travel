<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\City_airport;
use App\Contacts\SystemVariable;

class CityAirportController extends Controller {
	
	public function __construct(SystemVariable $system)
	{
		$this->system=$system;
	}
	
	/**
	 * Display a listing of airline information.
	 *
	 * @return Response
	 */
	public function index()
	{
		$airportList=array();
		$airportList=City_airport::orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		// 		dd($airportList->toArray());
		return view('etravel/airport/index',['airportList'=>$airportList,'breadcrumb' => 'List Of City Airport']);
	}
	
	/**
	 * Show the form for creating a Airline record.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$rules=array(
			'airport'=>'required',
		);//
		// 		dd($request->all());
		$this->validate($request, $rules);
		$airline=new City_airport();
		$airline->airport=$request->input('airport');
		$airline->save();
		return redirect('/cityAirport');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(City_airport $airport)
	{
		return view('/etravel/airport/show',['airport'=>$airport]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(City_airport $airport)
	{
		return view('/etravel/airport/edit',['airport'=>$airport]);//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,City_airport $airport)
	{
		$rules=array(
			'airport'=>'required',
		);
		$this->validate($request, $rules);
		$airport->airport=$request->input('airport');
		$airport->save();
		return view('/etravel/airport/show',['airport'=>$airport]);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(City_airport $airport)
	{
		if ($airport->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
	}
	
	public function search(Request $request)
	{
		$query=$request->input('q');
		$res = City_airport::where('airport','like','%'.$query.'%')->get(['airport','id']);
		$data=[];
		foreach ($res as $item){
			$item->id=$item->airport;
			$item->name=$item->airport;
			$data[]=$item->airport;
			unset($item->airport);
		}
		// 		dd($res->toArray());
		return response()->json($data);
	}
}


