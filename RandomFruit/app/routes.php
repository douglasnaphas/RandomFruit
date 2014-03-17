<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', function(){
	return Redirect::route('login');
});
Route::any('login', array('as' => 'login', 'uses' => 'UserController@loginAction'));

Route::any('dash', array('as' => 'dash', function(){
	return View::make('instructordash');
}));
