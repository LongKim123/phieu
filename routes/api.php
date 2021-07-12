<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register','ApiRegisterController@register');
Route::post('list-user','ApiRegisterController@list_user');
Route::post('login','ApiRegisterController@login');
Route::post('list-menu','MenusController@index');
Route::post('delete-menu','MenusController@delete');
Route::post('refresh-token','ApiRegisterController@refresh_token');
Route::post('delete-token','ApiRegisterController@delete_token');
Route::get('get-cate','MenusController@recusive');
Route::post('get-cate-edit','MenusController@recusive_edit');
Route::post('add-menu','MenusController@store');
Route::post('edit-menu','MenusController@edit');