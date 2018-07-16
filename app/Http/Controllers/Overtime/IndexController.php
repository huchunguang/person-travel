<?php namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;

use App\Contacts\SystemVariable;
use App\Repositories\UserRepository;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Overtime;
use App\Http\Traits\parseSearchFilter;


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
	public function index(Request $request)
	{
		$filter = $this->buildTableFilter($request);
		$columns= $request->input('columns','');
		$order=$request->input('order','');
		$result= Overtime::where('user_id', $request->get('user_id'));
		if (isset($filter) && !empty($filter)){
			foreach ($filter as $key=>$filterItem){
				$result->where($key,'like',"%{$filterItem}%");
			}
		}
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
