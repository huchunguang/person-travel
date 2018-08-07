<?php namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Overtime_rate;



class RateController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$rateList=array();
		$rateList=Overtime_rate::orderBy('created_at','DESC')->paginate(PAGE_SIZE);
		// 		dd($rateList->toArray());
		return view('/overtime/rate/index',['rateList'=>$rateList,'breadcrumb' => 'List Of Rate']);
		
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
		
		$rules=array(
			'rate'=>'required',
		);
		// 		dd($request->all());
		$this->validate($request, $rules);
		if (Overtime_rate::create($request->all())){
			return redirect('/overtime/rate');
		}
		
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Overtime_rate $rate)
	{
		return view('/overtime/rate/show',['rate'=>$rate]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Overtime_rate $rate)
	{
		return view('/overtime/rate/edit',['rate'=>$rate]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,Overtime_rate $rate)
	{
		
		$rules=array(
			'rate'=>'required',
		);
		$this->validate($request, $rules);
		$rate=$rate::updateOrCreate(['id'=>$rate->id],$request->all());
		return view('/overtime/rate/show',['rate'=>$rate]);
		
		
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Overtime_rate $rate)
	{
		if ($rate->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
		
		
	}
	
}
