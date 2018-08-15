<?php
namespace App\Http\Controllers\Overtime;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Overtime;
use App\Http\Traits\parseSearchFilter;
use Illuminate\Support\Facades\Event;
use App\Events\OvertimeNotify;

class ApprovalController extends Controller
{
	
	use parseSearchFilter;

	/**
	 * Display a listing of the overtime request.
	 * 
	 * @param Request $request        	
	 * @param unknown $status        	
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function index(Request $request, $status = null)
	{
		$filter = $this->buildTableFilter($request);
		$columns = $request->input('columns', '');
		$order = $request->input('order', '');
		// dd($status);
		$result = Overtime::OfStatus($status)->where('hr_approver', $request->get('user_id'));
		if (isset($filter) && ! empty($filter)) {
			foreach ($filter as $key => $filterItem) {
				$result->where($key, 'like', "%{$filterItem}%");
			}
		}
		//
		$recordsFiltered = $result->count();
		if (isset($order) && ! empty($order)) {
			foreach ($order as $orderItem) {
				$result->orderBy($columns[$orderItem['column']]['data'], $orderItem['dir']);
			}
		}
		$result = $result->skip($request->input('start', 0))
			->take($request->length ? $request->length : PAGE_SIZE)
			->get()
			->map(function ($item, $key) {
			$item['position'] = $item->position;
			$item['shift']=$item->shift()->first()->shift;
			$item['rate']=$item->rate()->first()->rate;
			$item['reason']=$item->reason()->first()->reason_subject;
// 			$item['igg']=$item->igg()->first()->igg;
			
			return $item;
		});
		return response()->json([ 
			
			'data' => $result,
			'draw' => $request->draw,
			'recordsTotal' => Overtime::count(),
			'recordsFiltered' => $recordsFiltered
		]);
	}

	public function listAll(Request $request, $status = null)
	{
		return view('/overtime/approval/list', compact('status'));
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
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * 
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Reject the specified resource in storage.
	 * 
	 * @param Request $request        	
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function reject(Request $request)
	{
// 		dd($request->all());
		$rules=array(
			'hr_reject_comment'=>'required'
		);
		$this->validate($request, $rules);
		$updateData = [ ];
		$updateData['status'] = 'rejected';
		$updateData['hr_comment'] = $request->input('hr_reject_comment', '');
// 		dd($updateData);
		$overtime=Overtime::find($request->input('chk_overtime_id'));
		$overtime->map(function ($item, $key) use ($updateData,$request) {
			$item->update($updateData);
// 			dd($item);
			Event::fire(new OvertimeNotify($item, $request, 'rejected'));
			
		});
		return redirect()->route('approvalList', [ 
			
			'status' => 'rejected'
		]);
	}

	/**
	 * Approve the specified resource from storage.
	 * 
	 * @param Request $request        	
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function approve(Request $request)
	{
// 		dd($request->all());
		$updateData = [ ];
		$updateData['status'] = 'approved';
		$updateData['hr_comment'] = $request->input('hr_approval_comment', '');
		$overtime = Overtime::find($request->input('chk_overtime_id'));
		$overtime->map(function ($item, $key) use ($updateData,$request) {
			$item->update($updateData);
// 			dd($item);
			Event::fire(new OvertimeNotify($item, $request, 'approved'));
		});
		return redirect()->route('approvalList', [ 
			
			'status' => 'approved'
		]);
	}
}
