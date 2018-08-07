<?php namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Overtime_shift;

class ShiftController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$shiftList=array();
		$shiftList=Overtime_shift::orderBy('created_at','DESC')->paginate(PAGE_SIZE);
// 		dd($shiftList->toArray());
		return view('/overtime/shift/index',['shiftList'=>$shiftList,'breadcrumb' => 'List Of Shift']);
		
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
			'shift'=>'required',
		);
		// 		dd($request->all());
		$this->validate($request, $rules);
		if (Overtime_shift::create($request->all())){
			return redirect('/overtime/shift');
		}
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Overtime_shift $shift)
	{
		return view('/overtime/shift/show',['shift'=>$shift]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Overtime_shift $shift)
	{
		return view('/overtime/shift/edit',['shift'=>$shift]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,Overtime_shift $shift)
	{
		
		$rules=array(
			'shift'=>'required',
		);
		$this->validate($request, $rules);
		$shift=$shift::updateOrCreate(['id'=>$shift->id],$request->all());
		return view('/overtime/shift/show',['shift'=>$shift]);
		
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Overtime_shift $shift)
	{
		if ($shift->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
		
		
	}

}
