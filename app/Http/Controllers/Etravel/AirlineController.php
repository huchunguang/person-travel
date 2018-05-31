<?php namespace App\Http\Controllers\Etravel;

use App\Http\Controllers\Controller;

use App\Airline;
use App\Contacts\SystemVariable;
use Illuminate\Http\Request;

class AirlineController extends Controller {
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
		//
		$airlineList=array();
		$airlineList=Airline::orderBy('created_at','DESC')->paginate(PAGE_SIZE);
// 		dd($airlineList->toArray());
		return view('etravel/airline/index',['airlineList'=>$airlineList,'breadcrumb' => 'List Of Airline']);
		
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
			'airline_name'=>'required',
			'airline_code'=>'required'
		);//
// 		dd($request->all());
		$this->validate($request, $rules);
		$airline=new Airline;
		$airline->airline_name=$request->input('airline_name');
		$airline->airline_code=$request->input('airline_code');
		$airline->save();
		return redirect('/etravel/airline');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Airline $airline)
	{
		return view('/etravel/airline/show',['airline'=>$airline]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Airline $airline)
	{
		return view('/etravel/airline/edit',['airline'=>$airline]);//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,Airline $airline)
	{
		$rules=array(
			'airline_name'=>'required',
			'airline_code'=>'required',
		);
		$this->validate($request, $rules);
		$airline->airline_name=$request->input('airline_name');
		$airline->airline_code=$request->input('airline_code');
		$airline->save();
		return view('/etravel/airline/show',['airline'=>$airline]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Airline $airline)
	{
		if ($airline->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
	}

}
