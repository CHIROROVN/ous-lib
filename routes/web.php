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

	// menu
	Route::get('/menu', ['as' => 'backend.menu.index', 'uses' => 'MenuController@index']);	
	//Info
	Route::get('/infos', ['as' => 'backend.infos.index', 'uses' => 'InfoController@index']);
	Route::get('/infos/regist', ['as' => 'backend.infos.regist', 'uses' => 'InfoController@regist']);
	Route::post('/infos/regist', ['as' => 'backend.infos.regist', 'uses' => 'InfoController@postRegist']);
	Route::get('/infos/regist_confirm', ['as' => 'backend.infos.regist_cnf', 'uses' => 'InfoController@registCnf']);
	Route::get('/infos/regist_save', ['as' => 'backend.infos.regist_save', 'uses' => 'InfoController@registSave']);
	Route::get('/infos/regist_back', ['as' => 'backend.infos.regist_back', 'uses' => 'InfoController@registBack']);
	Route::get('/infos/edit/{id}', ['as' => 'backend.infos.edit', 'uses' => 'InfoController@edit']);
	Route::post('/infos/edit/{id}', ['as' => 'backend.infos.edit', 'uses' => 'InfoController@postEdit']);
	Route::get('/infos/edit_cnf/{id}', ['as' => 'backend.infos.edit_cnf', 'uses' => 'InfoController@editCnf']);
	Route::get('/infos/edit_save/{id}', ['as' => 'backend.infos.edit_save', 'uses' => 'InfoController@editSave']);
	Route::get('/infos/edit_back/{id}', ['as' => 'backend.infos.edit_back', 'uses' => 'InfoController@editBack']);
	Route::get('/infos/detail/{id}', ['as' => 'backend.infos.detail', 'uses' => 'InfoController@detail']);
	Route::get('/infos/delete/{id}', ['as' => 'backend.infos.delete', 'uses' => 'InfoController@delete']);
	Route::get('/infos/delete_save/{id}', ['as' => 'backend.infos.delete_save', 'uses' => 'InfoController@deleteSave']);	
	
});


Route::get('/manage', function(){
	return redirect()->route('backend.menu.index');
});	


