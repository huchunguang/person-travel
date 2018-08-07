<?php
namespace App\Http\ViewComposers;

use App\Repositories\OvertimeRepository;
use Illuminate\Contracts\View\View;
use App\Overtime_shift;
use App\Overtime_rate;
use App\Overtime_reason;
use App\Overtime_igg;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class OvertimeSiderBarComposer
{
	public function __construct(OvertimeRepository $overtime,UserRepository $user)
	{
		$this->overtime = $overtime;
		$this->user = $user;
	}

	/**
	 *
	 * @param View $view        	
	 */
	public function compose(View $view)
	{
		$view->with('overtimeRepository', $this->overtime)
			->with('shiftAll', Overtime_shift::all())
			->with('rateAll',Overtime_rate::all())
			->with('reasonAll',Overtime_reason::all())
			->with('iggAll',Overtime_igg::all())
			->with('currentUser',Auth::user())
			->with('hrUserList',$this->user->getHrList());
	}
}