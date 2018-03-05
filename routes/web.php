<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/', function(){
 	return redirect()->route('frontend.homepage.index');
});

Auth::routes();

Route::group(['prefix' => '', 'namespace' => 'Frontend'], function () 
{
	Route::get('/', ['as' => 'frontend.homepage.index', 'uses' => 'HomeController@index']);
	
});

Route::group(['prefix' => 'manage', 'namespace' => 'Backend'], function () {	
	Route::get('/users', ['as' => 'backend.users.index', 'uses' => 'UsersController@index']);
	Route::get('/users/login', ['as' => 'backend.users.login', 'uses' => 'UsersController@login']);
	Route::post('/users/login', ['as' => 'backend.users.login', 'uses' => 'UsersController@postLogin']);
	Route::get('/users/logout', ['as' => 'backend.users.logout', 'uses' => 'UsersController@logout']);
	
});


Route::get('/login', function(){
	return redirect()->route('backend.users.login');
});	


