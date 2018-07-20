<?php namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;
use App\Contacts\SystemVariable;
use App\Http\Requests\EditOvertimeRequest;
use App\Http\Requests\ReadOvertimeRequest;
use App\Http\Requests\StoreOvertimeRequest;
use App\Http\Requests\UpdateOvertimeRequest;
use App\Http\Traits\parseSearchFilter;
use App\Overtime;
use App\Overtime_counter;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;


class IndexController extends Controller {

	use parseSearchFilter;
	public function __construct(SystemVariable $system,UserRepository $user) 
	{
		$this->system=$system;
		$this->user=$user;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request,$status=null)
	{
		$filter = $this->buildTableFilter($request);
		$columns= $request->input('columns','');
		$order=$request->input('order','');
		$result= Overtime::OfStatus($status)->where('user_id', $request->get('user_id'));
		if (isset($filter) && !empty($filter)){
			foreach ($filter as $key=>$filterItem){
				$result->where($key,'like',"%{$filterItem}%");
			}
		}
// 		
		$recordsFiltered=$result->count();
		foreach ($order as $orderItem){
			$result->orderBy($columns[$orderItem['column']]['data'], $orderItem['dir']);
		}
		
		$result = $result->skip($request->input('start',0))->take($request->length)->get();
		return response()->json([ 
			
			'data' => $result,
			'draw' => $request->draw,
			'recordsTotal' => Overtime::count(),
			'recordsFiltered' =>$recordsFiltered,
		]);
	}

	/**
	 * Show the form for creating a new overtime request.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
// 		return response()->json(['name'=>'huchunguang']);
// 		$post_id = Cache::get('post_id');
// 		dd($post_id);
// 		$env = app()->environment();
// 		dd($env);
		$hrUserList = $this->user->getHrList();
// 		dd($hrUserList->toArray());
		return view('/overtime/index/create',compact('hrUserList'));
	}

	/**
	 * Store a newly created overtime request in storage.
	 *
	 * @return Response
	 */
	public function store(StoreOvertimeRequest $request)
	{
		//dd($request->all());
		$storeData = array ();
		$storeData = $request->all();
		$storeData['reference_id'] = Overtime_counter::generateRefId();
// 		dd($storeData);
		$result = Overtime::create($storeData);
		if ($result){
			 Overtime_counter::updateSeries();
					return redirect()->action('Overtime\DashboardController@index');
		}
	}

	/**
	 * Display the specified Overtime request details.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(ReadOvertimeRequest $request,Overtime $overtime)
	{
		return view('/overtime/index/show',compact('overtime'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(EditOvertimeRequest $request,Overtime $overtime)
	{
// 		dd($overtime->toArray());
		return view('/overtime/index/edit',compact('overtime'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateOvertimeRequest $request,Overtime $overtime)
	{
// 		dd(array_except($request->only($overtime->getFillable()),['reference_id']));
		$res = $overtime::updateOrCreate(['id'=>$overtime->id],array_except($request->only($overtime->getFillable()),['reference_id']));
		if ($res){
			return redirect()->route('overtimeDetail',['overtime'=>$overtime->id]);
		}
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
