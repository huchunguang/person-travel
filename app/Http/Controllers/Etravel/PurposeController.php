<?php namespace App\Http\Controllers\Etravel;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trip_purpose;
use Illuminate\Support\Facades\View;

class PurposeController extends Controller {

	/**
	 * Display a listing of the demostic visit purpose.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('/etravel/purpose/index',['purposeList'=>Trip_purpose::orderBy('created_at','DESC')->paginate(PAGE_SIZE)]);
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
	public function store(Request $request)
	{
		$rules=[
			'purpose_catgory'=>'required|unique:trip_purposes|max:255',
			'purpose_desc'=>'required',
		];
		$this->validate($request, $rules);
		$purpose = new Trip_purpose();
		$purpose->purpose_catgory=$request->input('purpose_catgory');
		$purpose->purpose_desc=$request->input('purpose_desc');
		if ($purpose->save()) {
			return redirect()->route('tripPurpose');
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Trip_purpose $purpose)
	{
		echo view('/etravel/purpose/show',['purpose'=>$purpose]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Trip_purpose $purpose)
	{
		echo view('/etravel/purpose/edit',['purpose'=>$purpose]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,Trip_purpose $purpose)
	{
		$rules=[
			'purpose_catgory'=>'required|unique:trip_purposes|max:255',
			'purpose_desc'=>'required',
		];
		$this->validate($request, $rules);
		$purpose->purpose_catgory=$request->input('purpose_catgory');
		$purpose->purpose_desc=$request->input('purpose_desc');
		$purpose->save();
		echo view('/etravel/purpose/show',['purpose'=>$purpose]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Trip_purpose $purpose)
	{
		if ($purpose->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
	}

}
