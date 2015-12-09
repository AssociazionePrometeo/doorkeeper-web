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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.resources.index');
    });
    Route::resource('users', 'UserController');
    Route::resource('resources', 'ResourceController');
    Route::resource('reservations', 'ReservationController');
    Route::resource('cards', 'CardController');
});

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {

    Route::get('/', function() {
        return response()->json(['message' => 'Welcome', 'status' => 'ok']);
    });

    Route::resource('resources', 'ResourceController', ['only' => ['index', 'show']]);
    Route::get('resources/{resources}/check/{tagId}', 'ResourceController@check');
    
    Route::get('reservations', 'ReservationController@index');
    Route::get('resources/{resources}/reservations', 'ReservationController@resource');
});
