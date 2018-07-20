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
				$router->post('index/{status?}',['as'=>'overtimeIndex','uses'=>'IndexController@index']);
				$router->post('store',['uses'=>'IndexController@store']);
				$router->get('edit/{overtime}',['uses'=>'indexController@edit']);
				$router->post('update/{overtime}',['uses'=>'indexController@update']);
				#List
				$router->get('list',['as'=>'overtimeList','uses'=>'ListController@index']);
				#Details
				$router->get('{overtime?}',['as'=>'overtimeDetail','uses'=>'indexController@show']);
			});
		});
	}
}