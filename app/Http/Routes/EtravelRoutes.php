<?php
namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class EtravelRoutes
{
	public function map(Registrar $router) 
	{
		
		
		$router->get('/', function (){
			return redirect()->route('dashboard');
		});
			$router->get('home', 'HomeController@index');
			$router->controllers([
				'auth' => 'Auth\AuthController',
				'password' => 'Auth\PasswordController',
			]);
			
			$router->resource('site', 'SiteController');
			
			$router->group(['prefix'=>'etravel','namespace'=>'Etravel','domain'=>'www.arkema-etravels.com'],function($router){
				$router->get('unknownUser',['as'=>'unknownUser','uses'=>'DashboardController@unknownUser']);
				$router->group(['middleware'=>'checkUser'],function($router){
					#DashBoard
					$router->get('dashboard',['as'=>'dashboard','uses'=>'DashboardController@index']);
					$router->post('trip',['as'=>'tripType','uses'=>'DashboardController@trip']);
					$router->get('trip/send','TripController@test');
					#Create
					$router->get('trip/create',['as'=>'internationalCreate','uses'=>'TripController@create']);
					$router->get('trip/create/demostic',['as'=>'demosticCreate','uses'=>'TripController@demosticCreate']);
					#Store
					$router->post('trip/store','TripController@store');
					$router->post('trip/storeNational','TripController@storeNational');
					#List
					$router->get('{user}/triplist',['as'=>'triplist','uses'=>'TripController@index']);
					$router->get('triplist/{trip}','TripController@tripDetails');
					$router->get('tripdemosticlist/{trip}',['as'=>'domesticDetail','uses'=>'TripController@tripDemosticDetails']);
					$router->get('tripnationallist/{trip}',['as'=>'internationalDetail','uses'=>'TripController@tripNationalDetails']);
					$router->get('trip/edit/{trip}','TripController@demosticEdit');
					$router->get('trip/cancel/{trip}','TripController@demosticCancel');
					$router->put('trip/update/{trip}','TripController@demosticUpdate');
					
					$router->get('trip/nationalEdit/{trip}','TripController@nationalEdit');
					$router->get('trip/nationalCancel/{trip}','TripController@nationalCancel');
					$router->put('trip/nationalUpdate/{trip}','TripController@nationalUpdate');
					
					#Manager Section
					$router->get('staff/travellist','ApproverController@index');
					$router->put('tripapproval/{trip}','ApproverController@approval');
					
					
					$router->get('approver',['uses'=>'ApproverController@getOverseasApprover','as'=>'overseasApprover']);
					
					#Configuration
					$router->resource('airline', 'AirlineController');
					
					
					#Etravel Admin
					$router->resource('announcement', 'AnnouncementController');
					$router->resource('purpose', 'PurposeController');
					$router->group(['prefix'=>'admin','namespace'=>'Admin'],function($router){
						$router->match(['get','post'],'hr-listing','TriplistController@index');
						
					});
				});
			});
				//
				$router->group(['middleware'=>'checkUser'],function($router){
					$router->get('delegate/index','DelegateController@index');
					$router->post('delegate/store','DelegateController@store');
				});
					$router->group([],function($router){
						$router->get('user/search','UserController@search');
						
						$router->get('country-sites/{country}','CountryController@sites');
						$router->get('sites/{country}','CountryController@sitesByAll');
						$router->get('site-companies/{site}','SiteController@getAccessDeps');
						#Site
						$router->get('site-users/{site}','SiteController@users');
						#Company
						$router->get('site-companys/{site_id}','CompanyController@getSiteCompanys');
						
						$router->get('site-company-departments/{site_id}/{company_id}','DepartmentController@getDepListBySiteIdCpId');
					});
						
						#Download
						$router->get('download','FileController@download');
						#Excel
						$router->get('excel/export','ExcelController@exportTripList');
						
						
	}
}