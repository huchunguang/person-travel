<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Controllers\Etravel\Admin\AdminController;

class CompanyController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	/**
	 * @desc get the charge of companys by the site identity
	 * @param Request $request
	 * @param integer $site_id
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getSiteCompanys(Request  $request,$site_id) 
	{
		$return = [];
		$return = $this->getCompanyListHRSecurity($site_id)->map(function($item,$key){
			return $item['company'];
		});
		return response()->json($return);
	}
	
	public function getCompanyWbsCode($company_id)
	{
		return response()->json($this->system->getWbscodeList($company_id));
		
	}
}
