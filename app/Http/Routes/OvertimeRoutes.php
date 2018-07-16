<?php
namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class OvertimeRoutes
{
	public function map(Registrar $router) 
	{
		$router->group(['prefix'=>'overtime','namespace'=>'Overtime'],function($router){
			$router->get('unknownUser',['as'=>'unknownUser','uses'=>'DashboardController@unknownUser']);
			$router->group(['middleware'=>'checkUser'],function($router){
				#DashBoard
				$router->get('dashboard',['uses'=>'DashboardController@index']);
				#Create
				$router->get('create',['as'=>'overtimeCreate','uses'=>'IndexController@create']);
				$router->get('index',['as'=>'overtimeIndex','uses'=>'IndexController@index']);
			});
		});
	}
}