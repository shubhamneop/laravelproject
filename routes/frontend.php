<?php


Route::get('/','FrontendController@index');
Route::get('/demo','FrontendController@shop');
Route::get('order','FrontendController@getOrder');

Route::get('checkout',function(){ return view('Frontend.checkout'); });

Route::get('login',function(){ return view('Frontend.login'); })->name('loginuser');
Route::get('contact',function(){ return view('Frontend.contact-us'); });

Route::get('forgetpassword',function(){ return view('Frontend.email');});

Route::post('userlogin','UserloginController@login');

Route::get('register',function(){ return view('Frontend.register');});
Route::post('register','UserloginController@store');

Route::post('logout','UserloginController@logout')->name('logout');


Route::get('/login/{social}','UserloginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback','UserloginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');


Route::resource('addresses', 'AddressesController');

Route::group(['middleware'=>'auth'],function(){


});

Route::get('add-to-cart/{id}','CartController@getAddToCart');
Route::get('productdetails/{id}','FrontendController@details');
Route::get('/carts','CartController@index');



Route::get('add-to-wishlist/{id}','WishlistController@store');
Route::get('wishlist','WishlistController@index');
Route::get('removeproduct/{id}','WishlistController@destroy');

Route::get('cart','CartController@getCart');
Route::get('reduce/{id}','CartController@getReduceByOne');
Route::get('add/{id}','CartController@getAddByOne');
Route::get('remove/{id}','CartController@getRemoveItem');

Route::post('coupon','CartController@checkCoupon');
Route::get('productCat','FrontendController@proCat');
Route::get('categories/{id}','FrontendController@productCat');
Route::get('check_out','CartController@getChekout');

Route::post('saveaddress','AddressesController@saveaddress');
Route::get('address/{id}','AddressesController@getAddress');

Route::get('profile','ProfileController@index');
Route::post('profileupdate','ProfileController@update');
Route::post('imageupload','ProfileController@updateimage');
Route::get('changepassword',function(){
  return view('Frontend.Profile.changepassword');
});
Route::post('changepassword','ProfileController@changePassword');

Route::post('paypal', 'PaymentController@payWithpaypal');
// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');

Route::get('payonfo',function(){ return view('Frontend.payinfo'); });

Route::post('saveorder','CartController@saveorder');

Route::get('trackorder',function(){$data = null;return view('Frontend.track',compact('data'));});
Route::post('trackorder','FrontendController@trackorder');

Route::post('contactus','ContactusController@store');


Route::get('test','FrontendController@test');

Route::get('success','CartController@update');
Route::post('newsletter','NewsletterController@store');

Route::get('/page/{page}', 'PageController@showpage');

Route::get('removecoupon','CartController@removecoupon');
