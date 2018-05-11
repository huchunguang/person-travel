<?php namespace App\Http\Controllers\Etravel;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Contacts\SystemVariable;
use App\Airline;

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
// 		dd(123123);
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
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
