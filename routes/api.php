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

  Route::get('admin/contacts','API\Frontend\ContactusController@index');
  Route::patch('admin/contacts/update','API\Frontend\ContactusController@update');
  Route::post('admin/contacts/show','API\Frontend\ContactusController@show');
  Route::delete('admin/contacts/delete','API\Frontend\ContactusController@destroy');

  Route::post('userprofile','API\Frontend\ProfileController@index');
  Route::post('updateprofile','API\Frontend\ProfileController@updateprofile');
  Route::post('updateprofileimage','API\Frontend\ProfileController@updateprofileimage');
  Route::post('changepassword','API\Frontend\ProfileController@changePassword');

  Route::get('admin/pages','API\Admin\PageController@index');
  Route::post('admin/pages','API\Admin\PageController@store');
  Route::patch('admin/pages/update','API\Admin\PageController@update');
  Route::post('admin/pages/show','API\Admin\PageController@show');
  Route::delete('admin/pages/delete','API\Admin\PageController@destroy');

  Route::get('admin/banners','API\Admin\BannerController@index');
  Route::post('admin/banners','API\Admin\BannerController@store');
  Route::post('admin/banners/update','API\Admin\BannerController@update');
  Route::post('admin/banners/show','API\Admin\BannerController@show');
  Route::delete('admin/banners/delete','API\Admin\BannerController@destroy');

  Route::get('admin/configuration','API\Admin\ConfigurationController@index');
  Route::post('admin/configuration','API\Admin\ConfigurationController@store');
  Route::patch('admin/configuration/update','API\Admin\ConfigurationController@update');
  Route::post('admin/configuration/show','API\Admin\ConfigurationController@show');
  Route::delete('admin/configuration/delete','API\Admin\ConfigurationController@destroy');

  Route::get('admin/coupons','API\Admin\CouponController@index');
  Route::post('admin/coupons','API\Admin\CouponController@store');
  Route::patch('admin/coupons/update','API\Admin\CouponController@update');
  Route::post('admin/coupons/show','API\Admin\CouponController@show');
  Route::delete('admin/coupons/delete','API\Admin\CouponController@destroy');

  Route::get('admin/categories','API\Admin\CategoryController@index');
  Route::post('admin/categories','API\Admin\CategoryController@store');
  Route::patch('admin/categories/update','API\Admin\CategoryController@update');
  Route::post('admin/categories/show','API\Admin\CategoryController@show');
  Route::delete('admin/categories/delete','API\Admin\CategoryController@destroy');

  Route::get('admin/users','API\Admin\UserController@index');
  Route::post('admin/users','API\Admin\UserController@store');
  Route::patch('admin/users/update','API\Admin\UserController@update');
  Route::post('admin/users/show','API\Admin\UserController@show');
  Route::delete('admin/users/delete','API\Admin\UserController@destroy');

  Route::get('admin/roles','API\Admin\RoleController@index');
  Route::post('admin/roles','API\Admin\RoleController@store');
  Route::patch('admin/roles/update','API\Admin\RoleController@update');
  Route::delete('admin/roles/delete','API\Admin\RoleController@destroy');








});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
