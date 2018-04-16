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

// Route::get('/', 'WelcomeController@index');

// Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['prefix'=>'etravel'],function(){
    Route::get('unknownUser',['as'=>'unknownUser','uses'=>'\App\Http\Controllers\Etravel\DashboardController@unknownUser']);
    Route::group(['middleware'=>'checkUser'],function(){
    		#DashBoard
        Route::get('dashboard',['as'=>'dashboardPanel','uses'=>'\App\Http\Controllers\Etravel\DashboardController@index']);
        #Create
        Route::get('trip/create','\App\Http\Controllers\Etravel\TripController@create');
        Route::get('trip/create/demostic',['as'=>'demosticCreate','uses'=>'\App\Http\Controllers\Etravel\TripController@demosticCreate']);
        #Store
        Route::post('trip/store','Etravel\TripController@store');
        #List
        Route::get('{user}/triplist',['as'=>'triplist','uses'=>'Etravel\TripController@index']);
        Route::get('triplist/{trip}','Etravel\TripController@tripDetails');
        Route::get('tripdemosticlist/{trip}','Etravel\TripController@tripDemosticDetails');
        
    });
});