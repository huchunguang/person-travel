<?php

namespace App\Http\Controllers\Overtime;

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
use App\Events\OvertimeNotify;
use Illuminate\Support\Facades\Event;

class IndexController extends Controller
{
	
	use parseSearchFilter;

	public function __construct(SystemVariable $system, UserRepository $user)
	{
		$this->system = $system;
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 * 
	 * @return Response
	 */
	public function index(Request $request, $status = null)
	{
		$filter = $this->buildTableFilter($request);
		$columns = $request->input('columns', '');
		$order = $request->input('order', '');
		$result = Overtime::OfStatus($status)->where('user_id', $request->get('user_id'));
		
		if (isset($filter) && ! empty($filter)) {
			foreach ($filter as $key => $filterItem) {
				$result->where($key, 'like', "%{$filterItem}%");
			}
		}
		//
		$recordsFiltered = $result->count();
		foreach ($order as $orderItem) {
			$result->orderBy($columns[$orderItem['column']]['data'], $orderItem['dir']);
		}
		
		$result = $result->skip($request->input('start', 0))
			->take($request->length)
			->get()
			->map(function ($item, $key) {
			$item['position'] = $item->position;
			$item['shift'] = $item->shift()
				->first()->shift;
			$item['rate'] = $item->rate()
				->first()->rate;
			$item['reason'] = $item->reason()
				->first()->reason_subject;
			// $item['igg']=$item->igg()->first()->igg;
			
			return $item;
		});
		;
		return response()->json([ 
			
			'data' => $result,
			'draw' => $request->draw,
			'recordsTotal' => Overtime::count(),
			'recordsFiltered' => $recordsFiltered
		]);
	}

	/**
	 * Show the form for creating a new overtime request.
	 * 
	 * @return Response
	 */
	public function create(Request $request)
	{
		$hrUserList = $this->user->getHrList();
		return view('/overtime/index/create', compact('hrUserList'));
	}

	/**
	 * Store a newly created overtime request in storage.
	 * 
	 * @return Response
	 */
	public function store(StoreOvertimeRequest $request)
	{
		$storeData = array ();
		$storeData = $request->all();
		$storeData['reference_id'] = Overtime_counter::generateRefId();
		$storeData['department_id'] = $this->system->DepartmentID;
		$storeData['country_id'] = $this->system->CountryAssignedID;
		$storeData['site_id'] = $this->system->SiteID;
		$storeData['company_id'] = $this->system->CompanyID;
		// dd($storeData);
		$newOvertime = Overtime::create($storeData);
		if ($newOvertime) {
			Overtime_counter::updateSeries();
			Event::fire(new OvertimeNotify($newOvertime, $request, 'submitted'));
			return redirect()->action('Overtime\DashboardController@index');
		}
	}

	/**
	 * Display the specified Overtime request details.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function show(ReadOvertimeRequest $request, Overtime $overtime)
	{
		return view('/overtime/index/show', compact('overtime'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function edit(EditOvertimeRequest $request, Overtime $overtime)
	{
		return view('/overtime/index/edit', compact('overtime'));
	}

	/**
	 * Update the specified resource in storage.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function update(UpdateOvertimeRequest $request, Overtime $overtime)
	{
		$res = $overtime::updateOrCreate([ 
			
			'id' => $overtime->id
		], array_except($request->only($overtime->getFillable()), [ 
			
			'reference_id'
		]));
		
		if ($res) {
			Event::fire(new OvertimeNotify($overtime, $request, $overtime->status));
			return redirect()->route('overtimeDetail', [ 
				
				'overtime' => $overtime->id
			]);
		}
	}
	
	public function cancel(Request $request,Overtime $overtime)
	{
		$overtime->status = 'cancelled';
		$overtime->save();
		Event::fire(new OvertimeNotify($overtime, $request, $overtime->status));
		return redirect('/overtime/' . $overtime->id);
		
	}

	/**
	 * Remove the specified resource from storage.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
