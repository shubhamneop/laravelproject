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
Route::get('/admin-dash', 'HomeController@index')->middleware('role:admin|inventory manager|order manager|superadmin');
Route::get('admin',function(){
    return view('login');
});
Route::post('admin','adminloginController@login')->name('login');
Route::post('logoutadmin','adminloginController@logout');
Route::get('/', function () {return view('welcome');});
Route::get('Error',function(){return view('error.403');})->name('error.403');
//Route::get('admin',function (){return view('login');})->name('adminlogin');
Route::get('path',function (){return view('master');});
// users routes
Route::get('admin/users','UserController@index')->name('users.index');
Route::post('users','UserController@store')->name('users.store');
Route::get('users/create','UserController@create')->name('users.create')->middleware('permission:user-create');
//Route::get('users/create2','UserController@create2')->name('users.new2')->middleware('permission:user-create');

Route::get('users/{users}','UserController@show')->name('users.show')->middleware('permission:user-list');
Route::patch('users/{users}','UserController@update')->name('users.update');
Route::delete('users/{users}','UserController@destroy')->name('users.destroy');
Route::get('users/{users}/edit','UserController@edit')->name('users.edit')->middleware('permission:user-edit');

// roles routes
Route::get('roles','RoleController@index')->name('roles.index')->middleware('permission:role-list');
Route::post('roles','RoleController@store')->name('roles.store');
Route::get('roles/create','RoleController@create')->name('roles.create')->middleware('permission:role-create');
Route::get('roles/{roles}','RoleController@show')->name('roles.show');
Route::patch('roles/{roles}','RoleController@update')->name('roles.update');
Route::delete('roles/{roles}','RoleController@destroy')->name('roles.destroy');
Route::get('roles/{roles}/edit','RoleController@edit')->name('roles.edit')->middleware('permission:role-edit');

//Route::get('register',function (){return view('register');})->name('register');
//Route::get('unauthorized',function (){return view('unauthorized');})->name('unauthorized');



//Auth::routes();
/*
Route::group(['middleware'=>['auth']],function (){
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});
*/


Route::resource('admin/configurations', 'Admin\\configurationsController')->middleware('role:admin');

Route::resource('admin/banners', 'Admin\\bannersController')->middleware('role:admin');

Route::resource('admin/categories','categoryController');

Route::resource('admin/product','productController');

Route::resource('admin/coupons', 'Admin\\couponsController');

Route::resource('admin/order','Admin\\OrderController');

Route::resource('admin/contactus', 'FrontEnd\\ContactusController');

Route::resource('admin/pages','FrontEnd\\PageController');

//gererate reports
Route::get('admin/reports',function(){return view('admin.reports.index');});
Route::get('admin/reports/customer','Admin\\ReportController@index');
Route::get('admin/reports/customer/{id}','Admin\\ReportController@show');
Route::get('admin/reports/coupon','Admin\\ReportController@allCoupon');
Route::get('admin/reports/sales','Admin\\ReportController@sales');






Route::get('index2','productController@index2');

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');


Route::get('myform/ajax/{id}','productController@myformAjax');


  
