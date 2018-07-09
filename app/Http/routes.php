<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function (){
	return redirect()->route('dashboard');
});
Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::resource('site', 'SiteController');

Route::group(['prefix'=>'etravel','namespace'=>'Etravel'],function(){
    Route::get('unknownUser',['as'=>'unknownUser','uses'=>'DashboardController@unknownUser']);
    Route::group(['middleware'=>'checkUser'],function(){
    		#DashBoard
        Route::get('dashboard',['as'=>'dashboard','uses'=>'DashboardController@index']);
        Route::post('trip',['as'=>'tripType','uses'=>'DashboardController@trip']);
        Route::get('trip/send','TripController@test');
        #Create
        Route::get('trip/create',['as'=>'internationalCreate','uses'=>'TripController@create']);
        Route::get('trip/create/demostic',['as'=>'demosticCreate','uses'=>'TripController@demosticCreate']);
        #Store
        Route::post('trip/store','TripController@store');
        Route::post('trip/storeNational','TripController@storeNational');
        #List
        Route::get('{user}/triplist',['as'=>'triplist','uses'=>'TripController@index']);
        Route::get('triplist/{trip}','TripController@tripDetails');
        Route::get('tripdemosticlist/{trip}',['as'=>'domesticDetail','uses'=>'TripController@tripDemosticDetails']);
        Route::get('tripnationallist/{trip}',['as'=>'internationalDetail','uses'=>'TripController@tripNationalDetails']);
        Route::get('trip/edit/{trip}','TripController@demosticEdit');
        Route::get('trip/cancel/{trip}','TripController@demosticCancel');
        Route::put('trip/update/{trip}','TripController@demosticUpdate');
        
        Route::get('trip/nationalEdit/{trip}','TripController@nationalEdit');
        Route::get('trip/nationalCancel/{trip}','TripController@nationalCancel');
        Route::put('trip/nationalUpdate/{trip}','TripController@nationalUpdate');
        
        #Manager Section
        Route::get('staff/travellist','ApproverController@index');
        Route::put('tripapproval/{trip}','ApproverController@approval');
        
        
       	Route::get('approver',['uses'=>'ApproverController@getOverseasApprover','as'=>'overseasApprover']);
       	
       	#Configuration
       	Route::resource('airline', 'AirlineController');
       	
       	
       	#Etravel Admin
       	Route::resource('announcement', 'AnnouncementController');
       	Route::resource('purpose', 'PurposeController');
       	Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
       		Route::match(['get','post'],'hr-listing','TriplistController@index');
        	
        });
    });
});
	//
Route::group(['middleware'=>'checkUser'],function(){
	Route::get('delegate/index','DelegateController@index');
	Route::post('delegate/store','DelegateController@store');
});
Route::group([],function(){
	Route::get('user/search','UserController@search');
	
	Route::get('country-sites/{country}','CountryController@sites');
	Route::get('sites/{country}','CountryController@sitesByAll');
	Route::get('site-companies/{site}','SiteController@getAccessDeps');
	#Site
	Route::get('site-users/{site}','SiteController@users');
	#Company
	Route::get('site-companys/{site_id}','CompanyController@getSiteCompanys');
	
	Route::get('site-company-departments/{site_id}/{company_id}','DepartmentController@getDepListBySiteIdCpId');
});

#Download
Route::get('download','FileController@download');
#Excel
Route::get('excel/export','ExcelController@exportTripList');

