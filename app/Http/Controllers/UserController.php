<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Repositories\UserRepository;

class UserController extends Controller {

	public function __construct(UserRepository $user) 
	{
		$this->user=$user;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function index(User $user)
	{
		$user->workflow=$this->user->isOverseasApprover($user)?1:$this->user->getWorkflowCfg($user)->workflow;
		$user->siteStr=$user->site()->first()->Site;
		return response()->json($user);
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
	
	public function search(Request $request)
	{
		$query=$request->input('q');
		$res = User::where('FirstName','like','%'.$query.'%')->paginate(PAGE_SIZE);
		foreach ($res as $item){
			$item->id=$item->UserID;
			$item->text=$item->LastName.' '.$item->FirstName;
		}
// 		dd($res->toArray());
		return response()->json($res->toArray());	
	}
	
	public function userSite(User $user)
	{
		
		return response()->json($user->site()->first());
	}
	
	public function getManager(User $user)
	{
		return response()->json($user->manager()->first());
	}
	
	public function getWorkflow(User $user=null)
	{
		return response()->json($this->user->getWorkflowCfg($user)->workflow);
	}
	
	public function tripOfPurpose(User $user)
	{
		return response()->json($this->user->purposeCatWithCompany($user));
	}
}
