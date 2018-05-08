<?php
namespace App\Http\ViewComposers;

use App\Contacts\SystemVariable;
use Illuminate\Contracts\View\View;

class CommonComposer
{
	public function __construct(SystemVariable $system)
	{
		$this->system=$system;
	}	
	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		$view->with('wbscodeList', $this->system->wbscodeList)->with('defaultCostCenterID',$this->system->defaultCostCenterID);
	}
}