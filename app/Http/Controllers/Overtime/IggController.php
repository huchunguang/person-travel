<?php namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;
use App\Contacts\SystemVariable;
use App\Overtime_igg;
use Illuminate\Http\Request;

class IggController extends Controller {

	public function __construct(SystemVariable $system) 
	{
		$this->system=$system;
	}

	/**
	 * Display a listing of airline information.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$iggList=array();
		$iggList=Overtime_igg::orderBy('created_at','DESC')->paginate(PAGE_SIZE);
// 		dd($iggList->toArray());
		return view('/overtime/igg/index',['iggList'=>$iggList,'breadcrumb' => 'List Of IGG']);
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
			'igg'=>'required',
		);
// 		dd($request->all());
		$this->validate($request, $rules);
		if (Overtime_igg::create($request->all())){
			return redirect('/overtime/igg');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Overtime_igg $igg)
	{
		return view('/overtime/igg/show',['igg'=>$igg]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Overtime_igg $overtime_igg)
	{
		return view('/overtime/igg/edit',['igg'=>$overtime_igg]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,Overtime_igg $igg)
	{
		$rules=array(
			'igg'=>'required',
		);
		$this->validate($request, $rules);
		$igg=$igg::updateOrCreate(['id'=>$igg->id],$request->all());
		return view('/overtime/igg/show',['igg'=>$igg]);
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Overtime_igg $igg)
	{
		if ($igg->delete()) {
			return response()->json(['res_info'=>['code'=>'100000','msg'=>'']]);
		}
		return response()->json(['res_info'=>['code'=>'100001','msg'=>'']]);
		
	}

}
