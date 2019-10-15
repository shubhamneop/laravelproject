<?php

use Illuminate\Http\Request;

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
Route::post('login','API\UserController@login');
Route::post('register','API\UserController@register');
Route::get('product','API\FrontendController@index');
Route::get('productdetails/{id}','API\FrontendController@productdetails');
Route::get('category/{id}','API\FrontendController@productcatgory');
Route::get('order','API\FrontendController@getOrder');
Route::post('trackorder','API\FrontendController@trackorder');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
