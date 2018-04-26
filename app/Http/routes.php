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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['prefix'=>'etravel','namespace'=>'Etravel'],function(){
    Route::get('unknownUser',['as'=>'unknownUser','uses'=>'DashboardController@unknownUser']);
    Route::group(['middleware'=>'checkUser'],function(){
    		#DashBoard
        Route::get('dashboard',['as'=>'dashboard','uses'=>'DashboardController@index']);
        Route::post('trip',['as'=>'tripType','uses'=>'DashboardController@trip']);
        
        #Create
        Route::get('trip/create',['as'=>'internationalCreate','uses'=>'TripController@create']);
        Route::get('trip/create/demostic',['as'=>'demosticCreate','uses'=>'TripController@demosticCreate']);
        #Store
        Route::post('trip/store','TripController@store');
        #List
        Route::get('{user}/triplist',['as'=>'triplist','uses'=>'TripController@index']);
        Route::get('triplist/{trip}','TripController@tripDetails');
        Route::get('tripdemosticlist/{trip}','TripController@tripDemosticDetails');
        Route::get('trip/edit/{trip}','TripController@demosticEdit');
        
        #TripPurpose
        Route::get('purpose',['as'=>'tripPurpose','uses'=>'PurposeController@index']);
        Route::post('purpose','PurposeController@store');
        Route::get('purpose/edit/{purpose}','PurposeController@edit');
        Route::get('purpose/{purpose}','PurposeController@show');
        Route::post('purpose/{purpose}','PurposeController@update');
        Route::post('purpose/destroy/{purpose}','PurposeController@destroy');
        #Manager Section
        Route::get('staff/travellist','ApproverController@index');
        Route::put('tripapproval/{trip}','ApproverController@approval');
        
    });
});