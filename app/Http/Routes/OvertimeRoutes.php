<?php
namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class OvertimeRoutes
{
	public function map(Registrar $router) 
	{
		$router->group(['domain'=>'www.arkema-etravel.com'], function($router){
			$router->get('/', function (){
				return redirect()->route('dashboard');
			});
			$router->group(['prefix'=>'overtime','namespace'=>'Overtime'],function($router){
				$router->get('unknownUser',['as'=>'unknownUser','uses'=>'DashboardController@unknownUser']);
				
				$router->group(['middleware'=>'checkUser'],function($router){
					#DashBoard
					$router->get('dashboard',['as'=>'dashboard','uses'=>'DashboardController@index']);
					#Create
					$router->get('create',['as'=>'overtimeCreate','uses'=>'IndexController@create']);
					$router->post('index/{status?}',['as'=>'overtimeIndex','uses'=>'IndexController@index']);
					$router->post('store',['uses'=>'IndexController@store']);
					$router->get('edit/{overtime}',['uses'=>'indexController@edit']);
					$router->post('update/{overtime}',['uses'=>'indexController@update']);
					#List
					$router->get('list',['as'=>'overtimeList','uses'=>'ListController@index']);
					$router->resource('igg', 'IggController');
					$router->resource('shift', 'ShiftController');
					$router->resource('rate', 'RateController');
					$router->resource('reason', 'ReasonController');
					
					#Report
					$router->group(['prefix'=>'hr','namespace'=>'Hr'],function($router){
						$router->match(['get','post'],'report','ReportController@index');
						
					});
						#Approval
						$router->get('approvalList/{status?}',['uses'=>'ApprovalController@listAll','as'=>'approvalList']);
						$router->post('approval/{status?}','ApprovalController@index');
						##approve
						$router->post('approve','ApprovalController@approve');
						##reject
						$router->post('reject','ApprovalController@reject');
						
						$router->get('{overtime}/cancel','indexController@cancel');
						#Details
						$router->get('{overtime?}',['as'=>'overtimeDetail','uses'=>'indexController@show']);//TO DO WHERE CONDITION
						
						
				});
			});
				#Report Excel
				$router->get('export/overtime','ExcelController@exportOvertimeList');
				
		});
	}
}