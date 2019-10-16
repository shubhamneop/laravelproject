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
Route::get('getallcategory','API\FrontendController@getCategory');
Route::post('products','API\FrontendController@getProduct');
Route::post('productsDetails','API\FrontendController@getProductDetails');
Route::get('product','API\FrontendController@index');
Route::get('productdetails/{id}','API\FrontendController@productdetails');
Route::get('category/{id}','API\FrontendController@productcatgory');
Route::post('contacts','API\Frontend\ContactusController@store');
Route::post('newsletter','API\Frontend\NewsletterController@store');


Route::group(['middleware'=>'auth:api'], function(){

  Route::resource('useraddress','API\Frontend\AddressController');
  Route::post('details', 'API\UserController@details');
  Route::get('order','API\FrontendController@getOrder');
  Route::post('trackorder','API\FrontendController@trackorder');
  Route::post('address','API\Frontend\AddressController@store');
  Route::post('userwishlist','API\Frontend\WishlistController@index');
  Route::post('wishlists','API\Frontend\WishlistController@store');
  Route::post('removewishlist','API\Frontend\WishlistController@remove');
  Route::get('contacts','API\Frontend\ContactusController@index');
  Route::post('contacts/{contactus}','API\Frontend\ContactusController@update');
  Route::delete('contacts/{contactus}','API\Frontend\ContactusController@destroy');
  Route::post('userprofile','API\Frontend\ProfileController@index');
  Route::post('updateprofile','API\Frontend\ProfileController@updateprofile');
  Route::post('updateprofileimage','API\Frontend\ProfileController@updateprofileimage');
  Route::post('changepassword','API\Frontend\ProfileController@changePassword');
  Route::post('updateaddress','API\Frontend\AddressController@update');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
