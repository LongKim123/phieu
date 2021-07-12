<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Mail\SendMail;
use App\Jobs\SendMailJob;
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
Route::get('/','UserController@check_remember')->name('/');


Route::prefix('users')->group(function(){
	Route::get('/index',[
		'as'=>'users.index',
		'uses'=>'UserController@index',
		'middleware'=>'checkuser:list_user'
	]);
	Route::get('/create',[
		'as'=>'users.create',
		'uses'=>'UserController@create',
		'middleware'=>'checkuser:create_user'
	]);
	Route::post('/store',[
		'as'=>'users.store',
		'uses'=>'UserController@store',
		'middleware'=>'checkuser:insert_user'
	]);
	Route::get('/delete/{id}',[
		'as'=>'users.delete',
		'uses'=>'UserController@delete',
		'middleware'=>'checkuser:delete_user'
	]);
	Route::get('/edit/{id}',[
		'as'=>'users.edit',
		'uses'=>'UserController@edit',
		'middleware'=>'checkuser:edit_user'
	]);
	Route::post('/update/{id}',[
		'as'=>'users.update',
		'uses'=>'UserController@update',
		'middleware'=>'checkuser:edit_user'
	]);
});



Route::prefix('roles')->group(function(){
	Route::get('/index',[
		'as'=>'roles.index',
		'uses'=>'RoleController@index',

	]);
	Route::get('/create',[
		'as'=>'roles.create',
		'uses'=>'RoleController@create'
	]);
	Route::post('/store',[
		'as'=>'roles.store',
		'uses'=>'RoleController@store'

	]);
	Route::get('/delete/{id}',[
		'as'=>'roles.delete',
		'uses'=>'RoleController@delete'
	]);
	
});
Route::prefix('login')->group(function(){
	
	Route::post('/check',[
		'as'=>'login.check',
		'uses'=>'UserController@check_login',
		'middleware'=>'loginuser:check_user'
	]);
	Route::get('/',[
		'as'=>'logout',
		'uses'=>'UserController@logout',

	]);
	
	
	
});
Route::get('send-all-mail','UserController@ngu'
);

