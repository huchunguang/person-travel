<?php namespace App\Http\Controllers\Etravel;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Country;
use App\Http\Controllers\SiteController;
use App\Trip_announcetype;

class AnnouncementController extends Controller
{

	/**
	 * Display a listing of the resource.
	 * 
	 * @return Response
	 */
	public function index()
	{
		return view('/etravel/announcement/index',['breadcrumb' => 'Announcements']);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$countryList = array();
		$countryList = Country::orderBy('Country')->select(['CountryID','Country'])->get();
		$typeList = Trip_announcetype::all();
		// 		dd($countryList->toArray());
		
		return view('/etravel/announcement/create',['countryList'=>$countryList,'typeList'=>$typeList]);
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
