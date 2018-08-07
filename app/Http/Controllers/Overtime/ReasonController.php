<?php namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Overtime_reason;

class ReasonController extends Controller {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$reasonList=array();
		$reasonList=Overtime_reason::orderBy('created_at','DESC')->paginate(PAGE_SIZE);
// 		dd($reasonList->toArray());
		return view('/overtime/reason/index',['reasonList'=>$reasonList,'breadcrumb' => 'List Of Reason']);
		
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
			'reason_subject'=>'required',
		);
		// 		dd($request->all());
		$this->validate($request, $rules);
		if (Overtime_reason::create($request->all())){
			return redirect('/overtime/reason');
		}
		
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Overtime_reason $reason)
	{
		return view('/overtime/reason/show',['reason'=>$reason]);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Overtime_reason $reason)
	{
		return view('/overtime/reason/edit',['reason'=>$reason]);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,Overtime_reason $reason)
	{
		
		$rules=array(
			'reason_subject'=>'required',
		);
		$this->validate($request, $rules);
		$reason=$reason::updateOrCreate(['id'=>$reason->id],$request->all());
		return view('/overtime/reason/show',['reason'=>$reason]);
		
		
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Overtime_reason $reason)
	{
		if ($reason->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
		
		
	}
	
}
